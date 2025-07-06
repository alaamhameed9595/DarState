<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Property;
use App\Models\User;
use App\Notifications\ContactNotification;
use App\Notifications\InquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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
        $inquiry = Inquiry::create($validated);
        $property = Property::find($validated['property_id']);

        // Add property title to the data for the notification
        $notificationData = array_merge($validated, [
            'title' => $property ? $property->title : 'Unknown Property'
        ]);

        // Send notification to admin users (for database storage)
        $adminUsers = User::role('admin')->orwhere('id',$property->agent_id)->get();
        if ($adminUsers->count() > 0) {
            Notification::send($adminUsers, new InquiryNotification($notificationData));
        }

        // Also send email notification
        Notification::route('mail', config('app.contact_email'))
            ->notify(new InquiryNotification($notificationData));

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
        return redirect()->back()->with('success', 'Inquiry deleted');
    }
}
