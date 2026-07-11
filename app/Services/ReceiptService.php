<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Receipt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ReceiptService
{
    public function generateReceipt(Payment $payment)
    {
        $receiptNumber = 'RCP-' . strtoupper(Str::random(10));
        
        // Generate signature
        $signaturePath = $this->generateSignature($payment);
        
        // Generate PDF
        $pdf = Pdf::loadView('receipts.pdf', [
            'payment' => $payment,
            'receiptNumber' => $receiptNumber,
            'signaturePath' => $signaturePath,
        ]);

        $fileName = 'receipts/' . $receiptNumber . '.pdf';
        Storage::disk('public')->put($fileName, $pdf->output());

        // Create receipt record
        $receipt = Receipt::create([
            'payment_id' => $payment->id,
            'user_id' => $payment->user_id,
            'receipt_number' => $receiptNumber,
            'file_path' => $fileName,
            'signature_path' => $signaturePath,
            'generated_at' => now(),
        ]);

        return $receipt;
    }

    protected function generateSignature(Payment $payment)
    {
        try {
            // Create a simple signature image
            $image = Image::canvas(200, 80, '#ffffff');
            
            // Add signature text
            $image->text('Digital Signature', 100, 40, function ($font) {
                $font->size(16);
                $font->color('#000000');
                $font->align('center');
                $font->valign('middle');
            });

            $signaturePath = 'signatures/' . Str::random(20) . '.png';
            Storage::disk('public')->put($signaturePath, $image->encode('png'));

            return $signaturePath;
        } catch (\Exception $e) {
            \Log::error('Signature generation failed: ' . $e->getMessage());
            return null;
        }
    }

    public function downloadReceipt(Receipt $receipt)
    {

        $disk = Storage::disk('public');

        if ($receipt->file_path && $disk->exists($receipt->file_path)) {
            return $disk->download($receipt->file_path, "Receipt_{$receipt->receipt_number}.pdf");
        }

        $receipt->load(['payment', 'user']);
        
        $pdf = Pdf::loadView('receipts.pdf', [
            'payment'       => $receipt->payment,
            'receiptNumber' => $receipt->receipt_number,
            'signaturePath' => $receipt->signature_path,
        ]);

        $fallbackFileName = 'receipts/' . str_replace('/', '_', $receipt->receipt_number) . '.pdf';
        $disk->put($fallbackFileName, $pdf->output());
        
        $receipt->update(['file_path' => $fallbackFileName]);

        return $pdf->download("Receipt_" . str_replace('/', '_', $receipt->receipt_number) . ".pdf");
    }
}