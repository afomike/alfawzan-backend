<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use App\Models\Document;
use App\Models\AgentLink;
use App\Models\PaymentReference;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $totalPayments = Payment::count();
        $paidPayments = Payment::where('status', 'paid')->count();
        $pendingPayments = Payment::where('status', 'pending')->count();
        
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_payments' => $totalPayments,
            'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
            'pending_payments' => $pendingPayments,
            'total_documents' => Document::count(),
            'total_agents' => User::where('role', 'agent')->count(),
        ];

        $recentPayments = Payment::with('user')->latest()->take(10)->get();
        $recentUsers = User::where('role', 'user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPayments', 'recentUsers', 'paidPayments'));
    }
}

