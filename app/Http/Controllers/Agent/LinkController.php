<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\AgentLink;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function show($uniqueLink)
    {
        $agentLink = AgentLink::where('unique_link', $uniqueLink)
            ->where('is_active', true)
            ->firstOrFail();

        return view('agent.link', compact('agentLink'));
    }
}

