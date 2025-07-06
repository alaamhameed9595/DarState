<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ContactNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Send notification to admin users (for database storage)
        $adminUsers = User::role('admin')->get();
        if ($adminUsers->count() > 0) {
            Notification::send($adminUsers, new ContactNotification($validated));
        }

        // Also send email notification
        Notification::route('mail', config('app.contact_email'))
            ->notify(new ContactNotification($validated));

        return back()->with('success', 'Your message has been sent!');
    }
}
