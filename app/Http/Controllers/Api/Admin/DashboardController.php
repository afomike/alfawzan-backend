<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $recentPayments = Payment::with('user')->latest()->take(10)->get();
        $recentUsers    = User::where('role', 'user')->latest()->take(5)->get();

        // Monthly revenue for last 12 months (SQLite-compatible)
        $monthlyRevenue = Payment::where('status', 'paid')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->selectRaw("strftime('%Y-%m', created_at) as month, SUM(amount) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $months = [];
        for ($i = 11; $i >= 0; $i--) {
            $key      = now()->subMonths($i)->format('Y-m');
            $months[] = [
                'month' => now()->subMonths($i)->format('M Y'),
                'total' => (float) ($monthlyRevenue[$key]->total ?? 0),
            ];
        }

        return response()->json([
            'stats' => [
                'total_users'      => User::where('role', 'user')->count(),
                'total_revenue'    => Payment::where('status', 'paid')->sum('amount'),
                'pending_payments' => Payment::where('status', 'pending')->count(),
                'paid_payments'    => Payment::where('status', 'paid')->count(),
                'total_documents'  => Document::count(),
                'total_agents'     => User::where('role', 'agent')->count(),
            ],
            'monthly_revenue' => $months,
            'recent_payments' => $recentPayments->map(fn($p) => [
                'id'                => $p->id,
                'payment_reference' => $p->payment_reference,
                'amount'            => $p->amount,
                'status'            => $p->status,
                'payment_method'    => $p->payment_method,
                'created_at'        => $p->created_at->toISOString(),
                'user'              => ['name' => $p->user->name, 'email' => $p->user->email],
            ]),
            'recent_users' => $recentUsers->map(fn($u) => [
                'id'         => $u->id,
                'name'       => $u->name,
                'email'      => $u->email,
                'created_at' => $u->created_at->toISOString(),
            ]),
        ]);
    }
}
