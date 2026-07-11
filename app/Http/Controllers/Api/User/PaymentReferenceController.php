<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\PaymentReference;
use App\Models\Payment;
use App\Models\DrivingSchoolRegistration;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PaymentReferenceController extends Controller
{
    /**
     * Display a listing of the payment references belonging to the authenticated user.
     * Endpoint: GET /api/user/payment-references
     */
    public function index(Request $request): JsonResponse
    {
        $references = PaymentReference::where('user_id', $request->user()->id)
            ->latest()
            ->paginate(20);

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
     * Display the specified payment reference details if owned by the authenticated user.
     * Endpoint: GET /api/user/payment-references/{id}
     */
    public function show(Request $request, $id): JsonResponse
    {
        $reference = PaymentReference::with(['creator', 'payment'])
            ->where('user_id', $request->user()->id)
            ->where('id', $id)
            ->first();

        if (!$reference) {
            return response()->json([
                'message' => 'Payment reference record not found or unauthorized access parameters.'
            ], 403);
        }

        return response()->json([
            'data' => $reference
        ], 200);
    }

public function verify(Request $request): JsonResponse
{
    $validated = $request->validate([
        'reference_id' => 'required|string',
        'application_id' => 'required|exists:driving_school_registrations,id', // Validates against your real table
    ]);

    $registration = DrivingSchoolRegistration::find($validated['application_id']);
    $expectedAmount = $registration->final_amount ?? 15000;

    $reference = PaymentReference::where('reference_id', $validated['reference_id'])
        ->where('user_id', $request->user()->id) 
        ->first();

    if (!$reference) {
        return response()->json([
            'status' => 'error',
            'message' => 'This reference code is invalid or was not assigned to your account.'
        ], 404);
    }

    $refAmount = is_string($reference->amount) ? floatval($reference->amount) : $reference->amount;
    if (floatval($refAmount) !== floatval($expectedAmount)) {
        return response()->json([
            'status' => 'error',
            'message' => 'The value of this reference code does not match your registration processing fee.'
        ], 422);
    }

    if ($reference->isUsed()) {
        return response()->json([
            'status' => 'error',
            'message' => 'This reference code has already been claimed and used.'
        ], 422);
    }

    if ($reference->isExpired()) {
        return response()->json([
            'status' => 'error',
            'message' => 'This reference code has expired.'
        ], 422);
    }

    // 4. If all validations pass, securely record the financial transaction
    $payment = DB::transaction(function () use ($reference, $registration, $validated, $request) {
        $reference->update(['status' => 'used']);

        $newPayment = Payment::create([
            'user_id'           => $request->user()->id,
            'reference_id'      => $validated['application_id'],
            'payment_reference' => $reference->reference_id,    
            'amount'            => $reference->amount,
            'status'            => 'paid',                      
            'payment_method'    => 'reference',                      
            'description'       => $reference->description ?? "Driving School Registration Course Fee Clearance",
        ]);

        $registration->update([
            'status'     => 'approved', 
            'payment_id' => $newPayment->id,  
        ]);

        return $newPayment;
    });

    return response()->json([
        'status' => 'success',
        'message' => 'Payment reference verified and registration ledger updated successfully!',
        'data' => $payment
    ], 200);
}
}
