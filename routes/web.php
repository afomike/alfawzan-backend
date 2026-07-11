<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PaymentReferenceController;
use App\Http\Controllers\Admin\AgentLinkController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\PaymentController as UserPaymentController;
use App\Http\Controllers\User\DocumentController as UserDocumentController;
use App\Http\Controllers\User\ReceiptController;
use App\Http\Controllers\Agent\DashboardController as AgentDashboardController;
use App\Http\Controllers\Agent\LinkController as AgentPublicLinkController;
use App\Http\Controllers\DrivingSchool\RegistrationController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Driving School Registration
Route::get('/driving-school/register', [RegistrationController::class, 'create'])->name('driving-school.register');
Route::post('/driving-school/register', [RegistrationController::class, 'store']);

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Payment References
    Route::resource('payment-references', PaymentReferenceController::class);
    
    // Agent Links
    Route::resource('agent-links', AgentLinkController::class);
    
    // Documents
    Route::resource('documents', DocumentController::class);
    
    // Payments
    Route::get('payments', [AdminPaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/{payment}', [AdminPaymentController::class, 'show'])->name('payments.show');
});

// User Routes
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    
    // Payments
    Route::get('payments', [UserPaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/create', [UserPaymentController::class, 'create'])->name('payments.create');
    Route::post('payments', [UserPaymentController::class, 'store'])->name('payments.store');
    Route::get('payments/{payment}', [UserPaymentController::class, 'show'])->name('payments.show');
    Route::get('payments/callback', [UserPaymentController::class, 'callback'])->name('payments.callback');
    
    // Documents
    Route::get('documents', [UserDocumentController::class, 'index'])->name('documents.index');
    Route::get('documents/{document}/download', [UserDocumentController::class, 'download'])->name('documents.download');
    
    // Receipts
    Route::get('receipts', [ReceiptController::class, 'index'])->name('receipts.index');
    Route::get('receipts/{receipt}', [ReceiptController::class, 'show'])->name('receipts.show');
    Route::get('receipts/{receipt}/download', [ReceiptController::class, 'download'])->name('receipts.download');
});

// Agent Routes
Route::middleware(['auth', 'agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('dashboard');
});

// Agent Link Public Access (must be after authenticated agent routes)
Route::get('/agent/{uniqueLink}', [AgentPublicLinkController::class, 'show'])->name('agent.link');

