<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentReference;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentReferenceController extends Controller
{
    public function index()
    {
        $references = PaymentReference::with(['user', 'creator'])->latest()->paginate(20);

        return response()->json([
            'data' => $references->map(fn($r) => $this->format($r)),
            'meta' => ['total' => $references->total(), 'current_page' => $references->currentPage(), 'last_page' => $references->lastPage()],
        ]);
    }

    public function users()
    {
        return response()->json([
            'data' => User::where('role', 'user')->select('id', 'name', 'email')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'     => 'nullable|exists:users,id',
            'amount'      => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'expires_at'  => 'nullable|date|after:now',
        ]);

        $reference = PaymentReference::create([
            ...$validated,
            'created_by' => $request->user()->id,
            'status'     => 'pending',
        ]);

        $reference->load(['user', 'creator']);
        return response()->json(['data' => $this->format($reference)], 201);
    }

    public function show(PaymentReference $paymentReference)
    {
        $paymentReference->load(['user', 'creator', 'payment']);
        return response()->json(['data' => $this->format($paymentReference)]);
    }

    public function updateStatus(Request $request, PaymentReference $paymentReference)
    {
        $request->validate([
            'status' => 'required|in:pending,used,expired',
        ]);

        $paymentReference->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Status updated.',
            'data'    => $this->format($paymentReference),
        ]);
    }

    public function destroy(PaymentReference $paymentReference)
    {
        if ($paymentReference->isUsed()) {
            return response()->json(['message' => 'Cannot delete a used payment reference.'], 422);
        }

        $paymentReference->delete();
        return response()->json(['message' => 'Reference deleted.']);
    }

    private function format(PaymentReference $r): array
    {
        return [
            'id'           => $r->id,
            'reference_id' => $r->reference_id,
            'amount'       => $r->amount,
            'description'  => $r->description,
            'status'       => $r->status,
            'expires_at'   => $r->expires_at?->toISOString(),
            'created_at'   => $r->created_at->toISOString(),
            'user'         => $r->user ? ['id' => $r->user->id, 'name' => $r->user->name, 'email' => $r->user->email] : null,
            'creator'      => $r->creator ? ['name' => $r->creator->name] : null,
        ];
    }
}
