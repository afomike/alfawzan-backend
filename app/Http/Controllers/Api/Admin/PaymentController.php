<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('user')->latest();
        
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('payment_reference', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"));
            });
        }

        $payments = $query->paginate(20);

        return response()->json([
            'data' => $payments->map(fn($p) => [
                'id'                => $p->id,
                'payment_reference' => $p->payment_reference,
                'amount'            => $p->amount,
                'status'            => $p->status,
                'payment_method'    => $p->payment_method,
                'description'       => $p->description,
                'created_at'        => $p->created_at->toISOString(),
                'user'              => ['id' => $p->user->id, 'name' => $p->user->name, 'email' => $p->user->email],
            ]),
            'meta' => [
                'total'        => $payments->total(),
                'current_page' => $payments->currentPage(),
                'last_page'    => $payments->lastPage(),
            ],
        ]);
    }
}