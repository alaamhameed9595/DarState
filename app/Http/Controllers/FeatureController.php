<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::with('properties')->paginate(20);
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.features.create');
    }

    public function store(Request $request)
    {
        $validated=$request->validate([
            'name' => 'required|string|max:255|unique:features,name',
            'description' => 'nullable|string|max:500',
            'icon' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:50',
            'is_active' => 'boolean'
        ]);

        Feature::create($validated);

        return redirect()->route('auth.features.index')->with('success', 'Feature added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated=$request->validate([
            'name' => 'required|string|max:255|unique:features,name,' . $id,
            'description' => 'nullable|string|max:500',
            'icon' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:50',
            'is_active' => 'boolean'
        ]);

        $feature = Feature::findOrFail($id);
        $feature->update($validated);

        return redirect()->route('auth.features.index')->with('success', 'Feature updated successfully!');
    }

    public function destroy($id)
    {
        $feature = Feature::findOrFail($id);

        if ($feature->properties()->count() > 0) {
            return redirect()->route('auth.features.index')
                ->with('error', 'Cannot delete feature. It is being used by ' . $feature->properties()->count() . ' properties.');
        }

        $feature->delete();
        return redirect()->route('auth.features.index')->with('success', 'Feature deleted successfully!');
    }
}
