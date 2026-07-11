<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentLink;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AgentLinkController extends Controller
{
    public function index(): JsonResponse
    {
        $links = AgentLink::with(['agent'])
            ->withCount('payments')
            ->latest()
            ->paginate(20);

        return response()->json([
            'data' => $links->map(fn($l) => $this->format($l)),
            'meta' => [
                'total' => $links->total(), 
                'current_page' => $links->currentPage(), 
                'last_page' => $links->lastPage()
            ],
        ]);
    }

    public function agents(): JsonResponse
    {
        return response()->json([
            'data' => User::where('role', 'agent')->select('id', 'name', 'email')->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'agent_id'    => 'nullable|exists:users,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
        ]);

        $validated['created_by'] = $request->user()->id;
        $link = AgentLink::create($validated);
        $link->load('agent');

        return response()->json(['data' => $this->format($link)], 201);
    }

    public function show(AgentLink $agentLink): JsonResponse
    {
        $agentLink->load(['agent', 'creator', 'payments.user']);
        
        $data = $this->format($agentLink);
        
        $data['created_by'] = $agentLink->creator ? $agentLink->creator->name : 'Admin User';
        
        $data['payments'] = $agentLink->payments->map(fn($p) => [
            'id'                => $p->id,
            'payment_reference' => $p->reference_id ?? $agentLink->unique_link,
            'amount'            => $p->amount,
            'status'            => $p->status,
            'created_at'        => $p->created_at ? $p->created_at->toISOString() : null,
            'user'              => $p->user ? [
                'name'  => $p->user->name,
                'email' => $p->user->email
            ] : ['name' => 'Unknown Student', 'email' => '—'],
        ]);

        return response()->json(['data' => $data]);
    }

    public function update(Request $request, AgentLink $agentLink): JsonResponse
    {
        $validated = $request->validate([
            'agent_id'    => 'nullable|exists:users,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
        ]);

        $agentLink->update($validated);
        $agentLink->load('agent');
        return response()->json(['data' => $this->format($agentLink)]);
    }

    public function destroy(AgentLink $agentLink): JsonResponse
    {
        $agentLink->delete();
        return response()->json(['message' => 'Agent link deleted.']);
    }

    private function format(AgentLink $l): array
    {
        return [
            'id'                 => $l->id,
            'name'               => $l->name,
            'description'        => $l->description ?? 'N/A',
            'link_reference'     => $l->unique_link,
            'bypass_landing_url' => $l->full_url,
            'status'             => $l->is_active ? 'Active' : 'Inactive',
            'enrolled_clients'   => $l->payments_count ?? $l->payments()->count(),
            'created_at'         => $l->created_at->toISOString(),
            'assigned_agent'     => $l->agent ? $l->agent->name : 'Unassigned Agent',
            'agent_details'      => $l->agent ? ['id' => $l->agent->id, 'name' => $l->agent->name] : null,
        ];
    }

    public function verifyPublicLink(\Illuminate\Http\Request $request)
    {
        $token = $request->query('token');
        
        return response()->json([
            'success' => true,
            'data' => [
                'course_id' => 1,
                'amount' => 25000, 
                'tier_key' => 'standard'
            ]
        ], 200);
    }
}