<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Services\ReceiptService;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    protected $receiptService;

    public function __construct(ReceiptService $receiptService)
    {
        $this->middleware('auth');
        $this->receiptService = $receiptService;
    }

    public function index()
    {
        $receipts = auth()->user()->receipts()->with('payment')->latest()->paginate(20);
        return view('user.receipts.index', compact('receipts'));
    }

    public function show(Receipt $receipt)
    {
        if ($receipt->user_id !== auth()->id()) {
            abort(403);
        }

        $receipt->load(['payment', 'user']);
        return view('user.receipts.show', compact('receipt'));
    }

    public function download(Receipt $receipt)
    {
        if ($receipt->user_id !== auth()->id()) {
            abort(403);
        }

        return $this->receiptService->downloadReceipt($receipt);
    }
}

