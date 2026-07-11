<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentReference;
use App\Services\PaystackService;
use App\Services\ReceiptService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $paystackService;
    protected $receiptService;

    public function __construct(PaystackService $paystackService, ReceiptService $receiptService)
    {
        $this->middleware('auth');
        $this->paystackService = $paystackService;
        $this->receiptService = $receiptService;
    }

    public function index()
    {
        $payments = auth()->user()->payments()->latest()->paginate(20);
        return view('user.payments.index', compact('payments'));
    }

    public function create()
    {
        return view('user.payments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'payment_method' => 'required|in:online,reference',
            'reference_id' => 'required_if:payment_method,reference|exists:payment_references,reference_id',
        ]);

        $user = auth()->user();
        $paymentReference = 'PAY-' . strtoupper(Str::random(12));

        $payment = Payment::create([
            'user_id' => $user->id,
            'reference_id' => $validated['reference_id'] ?? null,
            'payment_reference' => $paymentReference,
            'amount' => $validated['amount'],
            'status' => 'pending',
            'payment_method' => $validated['payment_method'],
            'description' => $validated['description'],
        ]);

        if ($validated['payment_method'] === 'reference') {
            $paymentRef = PaymentReference::where('reference_id', $validated['reference_id'])->first();
            
            if ($paymentRef && !$paymentRef->isUsed() && !$paymentRef->isExpired()) {
                if ($paymentRef->amount != $validated['amount']) {
                    return back()->withErrors(['amount' => 'Amount does not match the reference ID amount.']);
                }

                $payment->update([
                    'status' => 'paid',
                    'amount' => $paymentRef->amount,
                ]);

                $paymentRef->update(['status' => 'used']);

                // Generate receipt
                $this->receiptService->generateReceipt($payment);

                return redirect()->route('user.payments.show', $payment)
                    ->with('success', 'Payment completed successfully using reference ID.');
            } else {
                return back()->withErrors(['reference_id' => 'Invalid or expired reference ID.']);
            }
        }

        // Initialize Paystack payment
        $paystackData = [
            'email' => $user->email,
            'amount' => $validated['amount'],
            'reference' => $paymentReference,
            'callback_url' => route('user.payments.callback'),
            'metadata' => [
                'payment_id' => $payment->id,
                'user_id' => $user->id,
            ],
        ];

        $response = $this->paystackService->initializeTransaction($paystackData);

        if ($response['success']) {
            return redirect($response['data']['authorization_url']);
        }

        return back()->withErrors(['payment' => $response['message']]);
    }

    public function show(Payment $payment)
    {
        if ($payment->user_id !== auth()->id()) {
            abort(403);
        }

        $payment->load(['receipt']);
        return view('user.payments.show', compact('payment'));
    }

    public function callback(Request $request)
    {
        $reference = $request->query('reference');

        if (!$reference) {
            return redirect()->route('user.payments.index')
                ->with('error', 'Payment reference not found.');
        }

        $payment = Payment::where('payment_reference', $reference)->first();

        if (!$payment) {
            return redirect()->route('user.payments.index')
                ->with('error', 'Payment not found.');
        }

        $verification = $this->paystackService->verifyTransaction($reference);

        if ($verification['success'] && $verification['status']) {
            $payment->update([
                'status' => 'paid',
                'paystack_reference' => $verification['data']['reference'],
            ]);

            // Generate receipt if not exists
            if (!$payment->receipt) {
                $this->receiptService->generateReceipt($payment);
            }

            return redirect()->route('user.payments.show', $payment)
                ->with('success', 'Payment completed successfully.');
        }

        $payment->update(['status' => 'failed']);

        return redirect()->route('user.payments.show', $payment)
            ->with('error', 'Payment verification failed.');
    }
}

