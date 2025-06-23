<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $weekAgo = Carbon::now()->subWeek();

        $stats = [
            'total_properties' => Property::count(),
            'new_properties' => Property::where('created_at', '>=', $weekAgo)->count(),
            'total_users' => User::count(),
            'agents' => User::role('agent')->count(),
            'inquiries_today' => Inquiry::whereDate('created_at', $today)->count(),
            'properties_by_city' => Property::selectRaw('city, COUNT(*) as count')
                ->groupBy('city')
                ->orderByDesc('count')
                ->limit(5)
                ->get(),
        ];

        return view('admin.analytics.index', compact('stats'));
    }
}
