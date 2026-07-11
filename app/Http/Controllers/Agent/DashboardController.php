<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\AgentLink;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('agent');
    }

    public function index()
    {
        $agentLinks = AgentLink::where('agent_id', auth()->id())
            ->with('payments')
            ->latest()
            ->get();

        $totalPayments = \App\Models\Payment::whereHas('agentLink', function ($query) {
            $query->where('agent_id', auth()->id());
        })->where('status', 'paid')->sum('amount');

        return view('agent.dashboard', compact('agentLinks', 'totalPayments'));
    }
}

