<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentReference;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PaymentReferenceController extends Controller
{
    /**
     * Fetch all payment reference IDs with pagination.
     * Endpoint: GET /admin/payment-references
     */
    public function index(): JsonResponse
    {
        $references = PaymentReference::with(['user', 'creator'])->latest()->paginate(20);

        return response()->json([
            'data' => $references->items(),
            'meta' => [
                'total' => $references->total(),
                'current_page' => $references->currentPage(),
                'last_page' => $references->lastPage(),
            ]
        ], 200);
    }

    /**
     * Fetch list of users for assigning payment references.
     * Endpoint: GET /admin/payment-references/users
     */
    public function users(): JsonResponse
    {
        $users = User::where('role', 'user')
            ->select('id', 'name', 'email')
            ->get();

        return response()->json([
            'data' => $users
        ], 200);
    }

    /**
     * Create a new payment reference ID.
     * Endpoint: POST /admin/payment-references
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['status'] = 'pending';

        $paymentReference = PaymentReference::create($validated);
        $paymentReference->load(['user', 'creator']);

        return response()->json([
            'data' => $paymentReference
        ], 201);
    }

    /**
     * Fetch detailed information about a single payment reference.
     * Endpoint: GET /admin/payment-references/{id}
     */
    public function show(PaymentReference $paymentReference): JsonResponse
    {
        $paymentReference->load(['user', 'creator', 'payment']);

        return response()->json([
            'data' => $paymentReference
        ], 200);
    }

    /**
     * Update the status of a payment reference.
     * Endpoint: PATCH /admin/payment-references/{id}/status
     */
    public function updateStatus(Request $request, PaymentReference $paymentReference): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,used,expired'
        ]);

        $paymentReference->update([
            'status' => $validated['status']
        ]);

        $paymentReference->load(['user', 'creator', 'payment']);

        return response()->json([
            'message' => 'Status updated.',
            'data' => $paymentReference
        ], 200);
    }

   
    public function destroy(PaymentReference $paymentReference): JsonResponse
    {
        if ($paymentReference->isUsed()) {
            return response()->json([
                'message' => 'Cannot delete a used payment reference.'
            ], 422);
        }

        $paymentReference->delete();

        return response()->json([
            'message' => 'Reference deleted.'
        ], 200);
    }
}