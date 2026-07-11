<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receipt;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class AdminReceiptController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'studentId' => 'required',
            'receipts' => 'required|array',
            'receipts.*.paymentId' => 'required',
            'receipts.*.receiptNo' => 'required|string',
            'receipts.*.amount' => 'required|numeric',
        ]);

        try {
            return DB::transaction(function () use ($request) {
                
                foreach ($request->receipts as $receiptData) {
                    Receipt::create([
                        'user_id' => $request->studentId,
                        'payment_id' => $receiptData['paymentId'],
                        'receipt_number' => $receiptData['receiptNo'],
                        'file_path' => 'receipts/receipt_' . str_replace('/', '_', $receiptData['receiptNo']) . '.pdf',
                        'generated_at' => now(),
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Receipt entry generated successfully!'
                ], 201);
            });

        } catch (UniqueConstraintViolationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'A receipt has already been issued for this payment ID. Duplicates are not allowed.'
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An internal server error occurred while processing the receipt database entries.'
            ], 500);
        }
    }
}