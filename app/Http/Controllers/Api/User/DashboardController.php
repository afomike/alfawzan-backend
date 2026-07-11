<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user     = $request->user();
        $payments = $user->payments()->latest()->take(5)->get();
        $receipts = $user->receipts()->with('payment')->latest()->take(5)->get();

        return response()->json([
            'stats' => [
                'total_payments' => $user->payments()->count(),
                'total_spent'    => $user->payments()->where('status', 'paid')->sum('amount'),
                'total_receipts' => $user->receipts()->count(),
            ],
            'recent_payments' => $payments->map(fn($p) => [
                'id'                => $p->id,
                'payment_reference' => $p->payment_reference,
                'amount'            => $p->amount,
                'status'            => $p->status,
                'payment_method'    => $p->payment_method,
                'created_at'        => $p->created_at->toISOString(),
            ]),
            'recent_receipts' => $receipts->map(fn($r) => [
                'id'             => $r->id,
                'receipt_number' => $r->receipt_number,
                'amount'         => $r->payment?->amount,
                'generated_at'   => $r->generated_at?->toISOString(),
            ]),
        ]);
    }
}
