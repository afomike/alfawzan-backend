<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Services\CertificateService; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class CertificateController extends Controller
{
    public function __construct(protected CertificateService $certificateService) {}

    /**
     * Fetch all certificates assigned to the authenticated user
     */
    public function index(Request $request)
    {
        $certificates = $request->user()->certificates()
            ->latest('issued_at')
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
                'file_path'           => $cert->file_path,
            ]),
            'meta' => [
                'total'        => $certificates->total(),
                'current_page' => $certificates->currentPage(),
                'last_page'    => $certificates->lastPage(),
            ],
        ]);
    }


    public function verify(Request $request): JsonResponse
    {
        $request->validate([
            'certificate_number' => 'required|string',
        ]);

        $certificate = Certificate::with('user:id,name,email')
            ->where('certificate_number', $request->certificate_number)
            ->first();

        if (!$certificate) {
            return response()->json([
                'success' => false,
                'message' => 'No valid certificate registration matching that number could be found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Certificate registration validated successfully.',
            'data' => [
                'id'                  => $certificate->id,
                'certificate_number'  => $certificate->certificate_number,
                'student_name'        => $certificate->user ? $certificate->user->name : 'N/A',
                'license_class'       => $certificate->license_class,
                'license_class_label' => $certificate->license_class_label,
                'completed_at'        => $certificate->completed_at ? $certificate->completed_at->toISOString() : null,
                'issued_at'           => $certificate->issued_at ? $certificate->issued_at->toISOString() : null,
                'instructor_name'     => $certificate->instructor_name,
                'director_name'       => $certificate->director_name,
            ]
        ], 200);
    }

    public function download(Request $request, Certificate $certificate)
    {
        if ($request->user()->role !== 'admin' && $certificate->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized access to certificate registry.'], 403);
        }

        return $this->certificateService->downloadCertificate($certificate);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'studentId' => 'required',
            'certificateNumber' => 'required|string',
            'licenseClass' => 'required|string',
            'licenseClassLabel' => 'required|string',
            'completionDate' => 'required|date',
            'issueDate' => 'required|date',
            'instructor' => 'required|string',
            'director' => 'required|string',
        ]);

        $numberExists = Certificate::where('certificate_number', $request->certificateNumber)->exists();
        if ($numberExists) {
            return response()->json([
                'success' => false,
                'message' => "Certificate number '{$request->certificateNumber}' has already been assigned in the system."
            ], 422);
        }

        $studentClassExists = Certificate::where('user_id', $request->studentId)
            ->where('license_class', $request->licenseClass)
            ->exists();

        if ($studentClassExists) {
            return response()->json([
                'success' => false,
                'message' => "A driving completion certificate for Class {$request->licenseClass} has already been registered to this student."
            ], 422);
        }

        DB::beginTransaction();

        try {
            $certificate = Certificate::create([
                'user_id' => $request->studentId,
                'certificate_number' => $request->certificateNumber,
                'license_class' => $request->licenseClass,
                'license_class_label' => $request->licenseClassLabel,
                'completed_at' => $request->completionDate,
                'issued_at' => $request->issueDate,
                'instructor_name' => $request->instructor,
                'director_name' => $request->director,
                'file_path' => 'certificates/cert_' . str_replace('/', '_', $request->certificateNumber) . '.pdf',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Certificate generated and assigned successfully!',
                'data' => $certificate
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'An internal database exception occurred while saving the certificate record.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}