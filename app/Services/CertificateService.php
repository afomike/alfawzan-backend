<?php

namespace App\Services;

use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class CertificateService
{

    public function downloadCertificate(Certificate $certificate)
    {
        $disk = Storage::disk('public');

        if ($certificate->file_path && $disk->exists($certificate->file_path)) {
            $downloadName = "Certificate_" . str_replace('/', '_', $certificate->certificate_number) . ".pdf";
            return $disk->download($certificate->file_path, $downloadName);
        }

        $certificate->load('user');

        $schoolLogoUrl = null; 
        $signatureUrl = $certificate->signature_path ? storage_path('app/public/' . $certificate->signature_path) : null;

        $pdf = Pdf::loadView('certificates.pdf', [
            'certificate'   => $certificate,
            'schoolName'    => 'Al-Fawzan Driving School',
            'schoolLogoUrl' => $schoolLogoUrl,
            'signatureUrl'  => $signatureUrl,
        ]);
        
        $pdf->setPaper('a4', 'landscape');

        $fileName = 'certificates/cert_' . str_replace('/', '_', $certificate->certificate_number) . '.pdf';
        $disk->put($fileName, $pdf->output());


        $certificate->update(['file_path' => $fileName]);

        return $pdf->download("Certificate_" . str_replace('/', '_', $certificate->certificate_number) . ".pdf");
    }
}