<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::with('user')->paginate(15);
        return view('admin.agents.index', compact('agents'));
    }
    public function approve($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->approved = true;
        $agent->save();
        return back()->with('success', 'Agent approved');
    }
    public function ban($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->banned = true;
        $agent->save();
        return back()->with('success', 'Agent banned');
    }
}
