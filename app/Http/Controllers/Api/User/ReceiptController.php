<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Services\ReceiptService;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function __construct(protected ReceiptService $receiptService) {}

    public function index(Request $request)
    {
        $receipts = $request->user()->receipts()->with('payment')->latest()->paginate(20);

        return response()->json([
            'data' => $receipts->map(fn($r) => $this->formatReceipt($r)),
            'meta' => [
                'total'        => $receipts->total(),
                'current_page' => $receipts->currentPage(),
                'last_page'    => $receipts->lastPage(),
            ],
        ]);
    }

    public function show(Request $request, Receipt $receipt)
    {
        if ($receipt->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        $receipt->load(['payment', 'user']);
        return response()->json(['data' => $this->formatReceipt($receipt)]);
    }

    public function download(Request $request, Receipt $receipt)
    {
        if ($receipt->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        return $this->receiptService->downloadReceipt($receipt);
    }

    private function formatReceipt(Receipt $receipt): array
    {
        return [
            'id'             => $receipt->id,
            'receipt_number' => $receipt->receipt_number,
            'generated_at'   => $receipt->generated_at?->toISOString(),
            'payment'        => $receipt->payment ? [
                'id'                => $receipt->payment->id,
                'amount'            => $receipt->payment->amount,
                'payment_reference' => $receipt->payment->payment_reference,
                'payment_method'    => $receipt->payment->payment_method,
                'created_at'        => $receipt->payment->created_at->toISOString(),
            ] : null,
        ];
    }
}
