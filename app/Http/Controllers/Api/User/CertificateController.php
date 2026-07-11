<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Services\CertificateService;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
  /**
     * Fetch details for a specific certificate
     */
    public function show(Request $request, $id)
    {
        // Query the certificate ensuring it belongs to the logged-in user
        $certificate = $request->user()->certificates()->find($id);

        if (!$certificate) {
            return response()->json([
                'success' => false,
                'message' => 'Certificate record not found or unauthorized.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id'                  => $certificate->id,
                'certificate_number'  => $certificate->certificate_number,
                'license_class'       => $certificate->license_class,
                'license_class_label' => $certificate->license_class_label,
                'completed_at'        => $certificate->completed_at ? $certificate->completed_at->toISOString() : null,
                'issued_at'           => $certificate->issued_at ? $certificate->issued_at->toISOString() : null,
                'instructor_name'     => $certificate->instructor_name,
                'director_name'       => $certificate->director_name,
                'file_path'           => $certificate->file_path,
            ]
        ], 200);
    }
    
    public function index(Request $request)
    {
        $certificates = $request->user()->certificates()
            ->latest()
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $certificates->map(fn($cert) => [
                'id'                  => $cert->id,
                'certificate_number'  => $cert->certificate_number,
                'license_class'       => $cert->license_class,
                'license_class_label' => $cert->license_class_label,
                'completed_at'        => $cert->completed_at ? $cert->completed_at->toISOString() : null,
                'issued_at'           => $cert->issued_at ? $cert->issued_at->toISOString() : null,
                'instructor_name'     => $cert->instructor_name,
                'director_name'       => $cert->director_name,
            ]),
            'meta' => [
                'total'        => $certificates->total(),
                'current_page' => $certificates->currentPage(),
                'last_page'    => $certificates->lastPage(),
            ],
        ]);
    }

    /**
     * Download a certificate
     */
    public function download(Certificate $certificate, CertificateService $certificateService)
    {

        if ($certificate->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized Access Ledger.'], 403);
        }

        return $certificateService->downloadCertificate($certificate);
    }
}