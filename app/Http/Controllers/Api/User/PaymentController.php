<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentReference;
use App\Models\DrivingSchoolRegistration;
use App\Services\PaystackService;
use App\Services\ReceiptService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct(
        protected PaystackService $paystackService,
        protected ReceiptService $receiptService
    ) {}

    public function index(Request $request)
    {
        $payments = $request->user()->payments()->latest()->paginate(20);

        return response()->json([
            'data' => $payments->map(fn($p) => $this->formatPayment($p)),
            'meta' => [
                'total'        => $payments->total(),
                'per_page'     => $payments->perPage(),
                'current_page' => $payments->currentPage(),
                'last_page'    => $payments->lastPage(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount'         => 'required|numeric|min:1',
            'description'    => 'nullable|string',
            'payment_method' => 'required|in:online,reference',
            'reference_id'   => 'required_if:payment_method,reference|exists:payment_references,reference_id',
            'callback_url'   => 'nullable|url',
            'application_id' => 'required|exists:driving_school_registrations,id', 
        ]);

        $user = $request->user();
        $paymentReference = 'PAY-' . strtoupper(Str::random(12));

        $registration = DrivingSchoolRegistration::where('id', $validated['application_id'])
            ->where('user_id', $user->id)
            ->firstOrFail();

        $agentLinkId = $registration->agent_link_id;

        $payment = Payment::create([
            'user_id'           => $user->id,
            'reference_id'      => $validated['reference_id'] ?? null,
            'payment_reference' => $paymentReference,
            'amount'            => $validated['amount'],
            'status'            => 'pending',
            'payment_method'    => $validated['payment_method'],
            'description'       => $validated['description'] ?? null,
            'agent_link_id'     => $agentLinkId,
        ]);

        if ($validated['payment_method'] === 'reference') {
            $paymentRef = PaymentReference::where('reference_id', $validated['reference_id'])->first();

            if (!$paymentRef || $paymentRef->isUsed() || $paymentRef->isExpired()) {
                return response()->json(['message' => 'Invalid or expired reference ID.'], 422);
            }

            if ((float) $paymentRef->amount !== (float) $validated['amount']) {
                return response()->json(['message' => 'Amount does not match the reference ID amount.'], 422);
            }

            $payment->update(['status' => 'paid', 'amount' => $paymentRef->amount]);
            $paymentRef->update(['status' => 'used']);
            
      
            $registration->update([
                'payment_id' => $payment->id,

            ]);

            $this->receiptService->generateReceipt($payment);

            return response()->json([
                'type'    => 'reference',
                'payment' => $this->formatPayment($payment->fresh(['receipt'])),
            ]);
        }

        $callbackUrl = $validated['callback_url'] ?? config('app.url') . '/payment/callback';

        $response = $this->paystackService->initializeTransaction([
            'email'        => $user->email,
            'amount'       => $validated['amount'],
            'reference'    => $paymentReference,
            'callback_url' => $callbackUrl,
            'metadata'     => [
                'payment_id'     => $payment->id, 
                'user_id'        => $user->id,
                'application_id' => $registration->id 
            ],
        ]);

        if (!$response['success']) {
            $payment->delete();
            return response()->json(['message' => $response['message']], 502);
        }

        return response()->json([
            'type'              => 'online',
            'authorization_url' => $response['data']['authorization_url'],
            'payment_reference' => $paymentReference,
        ]);
    }

    public function show(Request $request, Payment $payment)
    {
        if ($payment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        $payment->load('receipt');
        return response()->json(['data' => $this->formatPayment($payment)]);
    }

    public function verify(Request $request)
    {
        $reference = $request->query('reference');
        if (!$reference) {
            return response()->json(['message' => 'Reference required.'], 422);
        }

        $payment = Payment::where('payment_reference', $reference)->first();
        if (!$payment) {
            return response()->json(['message' => 'Payment not found.'], 404);
        }

        if ($payment->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }

        $verification = $this->paystackService->verifyTransaction($reference);

        if ($verification['success'] && isset($verification['data']['status']) && $verification['data']['status'] === 'success') {
            $payment->update([
                'status'             => 'paid',
                'paystack_reference' => $verification['data']['reference'],
            ]);

            $metadata = $verification['data']['metadata'] ?? null;
            if ($metadata && isset($metadata['application_id'])) {
                DrivingSchoolRegistration::where('id', $metadata['application_id'])->update([
                    'payment_id' => $payment->id,
                ]);
            }

            if (!$payment->receipt) {
                $this->receiptService->generateReceipt($payment);
            }

            $formatted = $this->formatPayment($payment->fresh('receipt'));
            $formatted['application_id'] = $metadata['application_id'] ?? null;

            return response()->json(['data' => $formatted]);
        }

        $payment->update(['status' => 'failed']);
        return response()->json(['message' => 'Payment verification failed.'], 422);
    }

    private function formatPayment(Payment $payment): array
    {
        return [
            'id'                => $payment->id,
            'payment_reference' => $payment->payment_reference,
            'amount'            => $payment->amount,
            'status'            => $payment->status,
            'payment_method'    => $payment->payment_method,
            'description'       => $payment->description,
            'created_at'        => $payment->created_at->toISOString(),
            'receipt'           => $payment->receipt ? [
                'id'             => $payment->receipt->id,
                'receipt_number' => $payment->receipt->receipt_number,
            ] : null,
        ];
    }
}