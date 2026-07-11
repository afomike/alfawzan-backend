<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Api\User\PaymentController as UserPaymentController;
use App\Http\Controllers\Api\User\DocumentController as UserDocumentController;
use App\Http\Controllers\Api\User\ReceiptController as UserReceiptController;
use App\Http\Controllers\Api\User\ProfileController as UserProfileController;
use App\Http\Controllers\Api\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Api\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Api\Admin\PaymentReferenceController as AdminPaymentReferenceController;
use App\Http\Controllers\Api\Admin\AgentLinkController as AdminAgentLinkController;
use App\Http\Controllers\Api\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Api\Agent\DashboardController as AgentDashboardController;
use App\Http\Controllers\Api\DrivingSchool\RegistrationController;
use App\Http\Controllers\Api\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Api\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use App\Http\Controllers\Api\User\ApplicationController as UserApplicationController;
use App\Http\Controllers\Api\Admin\AdminReceiptController as AdminReceiptController;
use App\Http\Controllers\Api\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Api\User\CertificateController as UserCertificateController;
use App\Http\Controllers\Api\User\PaymentReferenceController as UserPaymentReferenceController;
use App\Http\Controllers\Api\Admin\AdminCourseController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']); 
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/user/reset-password', [AuthController::class, 'resetPassword']);
Route::get('/public/settings', function () {
    $keys = ['school_name','logo_url','tagline','address','phone','phone2','phone3','email','website',
             'facebook_url','instagram_url','twitter_url','seo_title','seo_description'];
    return response()->json(['data' => App\Models\Setting::getMany($keys)]);
});
Route::get('/driving-school/courses', [RegistrationController::class, 'index']);

Route::get('/driving-school/agent-links/verify', [AdminAgentLinkController::class, 'verifyPublicLink']);

Route::get('/certificates/verify', [AdminCertificateController::class, 'verify']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/user', [AuthController::class, 'user']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::post('/driving-school/register', [RegistrationController::class, 'store']);
    Route::get('/driving-school/register/{id}', [RegistrationController::class, 'show']);

    Route::prefix('user')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index']);
        Route::get('/payments', [UserPaymentController::class, 'index']);
        Route::post('/payments', [UserPaymentController::class, 'store']);
        Route::get('/payments/verify', [UserPaymentController::class, 'verify']);
        Route::get('/payments/{payment}', [UserPaymentController::class, 'show']);
        Route::get('/documents', [UserDocumentController::class, 'index']);
        Route::get('/documents/{document}/download', [UserDocumentController::class, 'download']);
        Route::get('/receipts', [UserReceiptController::class, 'index']);
        Route::get('/receipts/{receipt}', [UserReceiptController::class, 'show']);
        Route::get('/receipts/{receipt}/download', [UserReceiptController::class, 'download']);
        Route::put('/profile', [UserProfileController::class, 'update']);
        Route::get('/applications', [UserApplicationController::class, 'index']);
        Route::get('/applications/{id}', [UserApplicationController::class, 'show']);
        Route::put('/applications/{id}', [UserApplicationController::class, 'update']);
        Route::post('/applications/{id}/passport', [UserApplicationController::class, 'uploadPassport']);
        Route::delete('/applications/{id}', [UserApplicationController::class, 'destroy']);
        Route::get('/certificates', [UserCertificateController::class, 'index']);
        Route::get('/certificates/{id}', [UserCertificateController::class, 'show']);
        Route::get('/certificates/{certificate}/download', [UserCertificateController::class, 'download']);

        Route::get('/payment-references', [UserPaymentReferenceController::class, 'index']);
        Route::post('/payment-references/verify', [UserPaymentReferenceController::class, 'verify']); 
        Route::get('/payment-references/{id}', [UserPaymentReferenceController::class, 'show']);
    });

    // Admin routes
    Route::prefix('admin')->middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);
        Route::get('/payments', [AdminPaymentController::class, 'index']);
        Route::get('/payments/{payment}', [AdminPaymentController::class, 'show']);
        Route::get('/payment-references', [AdminPaymentReferenceController::class, 'index']);
        Route::get('/payment-references/users', [AdminPaymentReferenceController::class, 'users']);
        Route::post('/payment-references', [AdminPaymentReferenceController::class, 'store']);
        Route::get('/payment-references/{paymentReference}', [AdminPaymentReferenceController::class, 'show']);
        Route::patch('/payment-references/{paymentReference}/status', [AdminPaymentReferenceController::class, 'updateStatus']);
        Route::delete('/payment-references/{paymentReference}', [AdminPaymentReferenceController::class, 'destroy']);
        Route::get('/agent-links', [AdminAgentLinkController::class, 'index']);
        Route::get('/agent-links/agents', [AdminAgentLinkController::class, 'agents']);
        Route::post('/agent-links', [AdminAgentLinkController::class, 'store']);
        Route::get('/agent-links/{agentLink}', [AdminAgentLinkController::class, 'show']);
        Route::put('/agent-links/{agentLink}', [AdminAgentLinkController::class, 'update']);
        Route::delete('/agent-links/{agentLink}', [AdminAgentLinkController::class, 'destroy']);
        Route::get('/documents', [AdminDocumentController::class, 'index']);
        Route::post('/documents', [AdminDocumentController::class, 'store']);
        Route::put('/documents/{document}', [AdminDocumentController::class, 'update']);
        Route::delete('/documents/{document}', [AdminDocumentController::class, 'destroy']);
        Route::get('/users', [AdminUserController::class, 'index']);
        Route::get('/users/{id}', [AdminUserController::class, 'show']);
        Route::put('/users/{id}', [AdminUserController::class, 'update']);
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy']);
        Route::get('/students', [AdminStudentController::class, 'index']);
        Route::get('/students/{id}', [AdminStudentController::class, 'show']);
        Route::put('/students/{id}', [AdminStudentController::class, 'update']);
        Route::delete('/students/{id}', [AdminStudentController::class, 'destroy']);
        Route::post('/students/{id}/passport', [AdminStudentController::class, 'uploadPassport']);
        Route::patch('/students/{id}/status', [AdminStudentController::class, 'updateStatus']);
        Route::get('/settings', [AdminSettingsController::class, 'index']);
        Route::post('/settings', [AdminSettingsController::class, 'update']);
        Route::post('/settings/logo', [AdminSettingsController::class, 'uploadLogo']);
        Route::post('/settings/signature', [AdminSettingsController::class, 'uploadSignature']);
        Route::post('/receipts/generate', [AdminReceiptController::class, 'store']);
        Route::post('/certificates/generate', [AdminCertificateController::class, 'store']);
        Route::get('/user/certificates', [AdminCertificateController::class, 'index']);
        Route::get('/user/certificates/{certificate}/download', [AdminCertificateController::class, 'download']);
        Route::apiResource('courses', AdminCourseController::class);
    });

    // Agent routes
    Route::prefix('agent')->middleware('agent')->group(function () {
        Route::get('/dashboard', [AgentDashboardController::class, 'index']);
    });
});