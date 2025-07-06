<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use App\Models\Inquiry;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic counts
        $totalProperties = Property::count();
        $totalUsers = User::count();
        $totalInquiries = Inquiry::count();
        $totalFeatures = Feature::count();

        // Recent activity
        $recentProperties = Property::latest()->take(5)->get();
        $recentInquiries = Inquiry::latest()->take(5)->get();

        // Property statistics
        $propertiesByType = Property::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get();

        $propertiesByStatus = Property::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Price statistics
        $avgPrice = Property::avg('price');
        $maxPrice = Property::max('price');
        $minPrice = Property::min('price');

        // Monthly statistics
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $propertiesThisMonth = Property::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $inquiriesThisMonth = Inquiry::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        // Top performing properties (by inquiries)
        $topProperties = Property::withCount('inquiries')
            ->orderBy('inquiries_count', 'desc')
            ->take(5)
            ->get();

                // Chart data for property types
        $propertyTypeData = Property::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        // Monthly data for charts (last 6 months)
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M');

            $propertiesCount = Property::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();

            $inquiriesCount = Inquiry::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();

            $monthlyData[$monthName] = [
                'properties' => $propertiesCount,
                'inquiries' => $inquiriesCount
            ];
        }

        // Price range distribution
        $priceRanges = [
            'Under 500K' => Property::where('price', '<', 500000)->count(),
            '500K-1M' => Property::whereBetween('price', [500000, 1000000])->count(),
            '1M-2M' => Property::whereBetween('price', [1000000, 2000000])->count(),
            '2M-5M' => Property::whereBetween('price', [2000000, 5000000])->count(),
            '5M+' => Property::where('price', '>', 5000000)->count(),
        ];

        return view('dashboard', compact(
            'totalProperties',
            'totalUsers',
            'totalInquiries',
            'totalFeatures',
            'recentProperties',
            'recentInquiries',
            'propertiesByType',
            'propertiesByStatus',
            'avgPrice',
            'maxPrice',
            'minPrice',
            'propertiesThisMonth',
            'inquiriesThisMonth',
            'topProperties',
            'propertyTypeData',
            'monthlyData',
            'priceRanges'
        ));
    }
}
