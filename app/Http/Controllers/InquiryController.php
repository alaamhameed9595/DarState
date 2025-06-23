<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InquiryController extends Controller
{
    // Store inquiry (public)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'property_id' => 'required|exists:properties,id',
            'message' => 'required|string',
        ]);
        Inquiry::create($validated);
        return back()->with('success', 'Inquiry sent successfully');
    }

    // Agent views inquiries
    public function index()
    {
        $inquiries = auth()->user()->properties()
            ->with('inquiries')
            ->get()
            ->pluck('inquiries')
            ->flatten();
        return view('agent.inquiries.index', compact('inquiries'));
    }

    public function respond($id, Request $request)
    {
        // Add logic to respond (email etc)
        return back()->with('success', 'Responded to inquiry');
    }

    public function destroy($id)
    {
        Inquiry::findOrFail($id)->delete();
        return back()->with('success', 'Inquiry deleted');
    }
}
