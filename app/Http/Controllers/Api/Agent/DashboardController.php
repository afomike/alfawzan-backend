<?php

namespace App\Http\Controllers\Api\Agent;

use App\Http\Controllers\Controller;
use App\Models\AgentLink;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user       = $request->user();
        $agentLinks = AgentLink::where('agent_id', $user->id)
            ->withCount('payments')
            ->with(['payments' => fn($q) => $q->where('status', 'paid')])
            ->latest()
            ->get();

        $totalRevenue = Payment::whereHas('agentLink', fn($q) => $q->where('agent_id', $user->id))
            ->where('status', 'paid')->sum('amount');

        $totalPayments = Payment::whereHas('agentLink', fn($q) => $q->where('agent_id', $user->id))->count();

        return response()->json([
            'stats' => [
                'total_links'    => $agentLinks->count(),
                'total_payments' => $totalPayments,
                'total_revenue'  => $totalRevenue,
            ],
            'links' => $agentLinks->map(fn($l) => [
                'id'             => $l->id,
                'name'           => $l->name,
                'full_url'       => $l->full_url,
                'is_active'      => $l->is_active,
                'payments_count' => $l->payments_count,
                'revenue'        => $l->payments->sum('amount'),
            ]),
        ]);
    }
}
