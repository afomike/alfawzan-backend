<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentLink;
use App\Models\User;
use Illuminate\Http\Request;

class AgentLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $agentLinks = AgentLink::with(['agent', 'creator'])->latest()->paginate(20);
        return view('admin.agent-links.index', compact('agentLinks'));
    }

    public function create()
    {
        $agents = User::where('role', 'agent')->get();
        return view('admin.agent-links.create', compact('agents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'agent_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['is_active'] = $request->has('is_active');

        $agentLink = AgentLink::create($validated);

        return redirect()->route('admin.agent-links.index')
            ->with('success', 'Agent link created successfully. Unique link: ' . $agentLink->full_url);
    }

    public function show(AgentLink $agentLink)
    {
        $agentLink->load(['agent', 'creator', 'payments']);
        return view('admin.agent-links.show', compact('agentLink'));
    }

    public function edit(AgentLink $agentLink)
    {
        $agents = User::where('role', 'agent')->get();
        return view('admin.agent-links.edit', compact('agentLink', 'agents'));
    }

    public function update(Request $request, AgentLink $agentLink)
    {
        $validated = $request->validate([
            'agent_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $agentLink->update($validated);

        return redirect()->route('admin.agent-links.index')
            ->with('success', 'Agent link updated successfully.');
    }

    public function destroy(AgentLink $agentLink)
    {
        $agentLink->delete();

        return redirect()->route('admin.agent-links.index')
            ->with('success', 'Agent link deleted successfully.');
    }
}

