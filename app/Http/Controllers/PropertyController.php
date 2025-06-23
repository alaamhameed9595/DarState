<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Models\Feature;
use App\Models\Property;
use Cloudinary\Api\Upload\UploadApi;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query()->where('status', 'available');

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        $properties = $query->paginate(12);
        return view('admin.properties.index', compact('properties'));
    }

    public function show($id)
    {
        $property = Property::with('features', 'agent')->findOrFail($id);
        return view('admin.properties.show', compact('property'));
    }

    // Agent management views
    public function manage()
    {
        $properties = Property::where('agent_id', auth()->user()->id)->paginate(15);
        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $features = Feature::all();
        return view('admin.properties.create', compact('features'));
    }
    public function store(PropertyRequest $request)
    {
        try {
            // Get validated data
            $validated = $request->validated();

            // Create property with agent_id
            $validated['agent_id'] = auth()->user()->id;

            $property = Property::create($validated);

            // Handle multiple image uploads to Cloudinary
            if ($request->hasFile('images')) {
                $images = $request->file('images');

                // Check if Cloudinary is configured
                if (!config('cloudinary.cloud_url')) {
                    Log::warning('Cloudinary not configured, skipping image upload');
                    return back()
                        ->withInput()
                        ->with('error', 'Image upload is not configured. Please contact administrator.');
                }

                foreach ($images as $image) {
                    try {
                        $cloudinaryResponse = (new UploadApi())->upload($image->getRealPath(), [
                            'folder' => 'properties',
                            'transformation' => [
                                'width' => 800,
                                'height' => 600,
                                'crop' => 'fill',
                                'quality' => 'auto'
                            ]
                        ]);

                        // Store image URL in PropertyImage model
                        $property->images()->create([
                            'image_url' => $cloudinaryResponse['secure_url']
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Image upload failed: ' . $e->getMessage());
                        // Continue with other images even if one fails
                    }
                }
            }

            // Sync features if provided
            if ($request->filled('features')) {
                $property->features()->sync($request->features);
            }

            return redirect()
                ->route('auth.properties.manage')
                ->with('success', 'Property created successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Property creation failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return back()
                ->withInput()
                ->with('error', 'Failed to create property: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $features = Feature::all();
        $property = Property::findOrFail($id);
        return view('admin.properties.edit', compact('property', 'features'));
    }
    public function update(PropertyRequest $request, $id)
    {
        try {

            // Debug logging
            Log::info('Property update request received', [
                'property_id' => $id,
                'user_id' => auth()->user()->id,
                'has_files' => $request->hasFile('images'),
                'file_count' => $request->hasFile('images') ? count($request->file('images')) : 0,
                'request_data' => $request->except(['images'])
            ]);

            // Get validated data
            $validated = $request->validated();

            $property = Property::findOrFail($id);

            // Handle multiple image uploads to Cloudinary
            if ($request->hasFile('images')) {
                $images = $request->file('images');

                foreach ($images as $image) {
                    $cloudinaryResponse = (new UploadApi())->upload($image->getRealPath(), [
                        'folder' => 'properties',
                        'transformation' => [
                            'width' => 800,
                            'height' => 600,
                            'crop' => 'fill',
                            'quality' => 'auto'
                        ]
                    ]);

                    // Store image URL in PropertyImage model
                    $property->images()->create([
                        'image_url' => $cloudinaryResponse['secure_url']
                    ]);
                }
            }

            $property->update($validated);

            if ($request->filled('features')) {
                $property->features()->sync($request->features);
            }

            Log::info('Property updated successfully', ['property_id' => $id]);

            return redirect()
                ->route('auth.properties.manage')
                ->with('success', 'Property updated successfully!');
        } catch (\Exception $e) {
            Log::error('Property update failed', [
                'property_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to update property: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();
        return redirect()->route('auth.properties.manage')->with('success', 'Property deleted');
    }

    public function deleteImage($imageId)
    {
        try {
            $image = \App\Models\PropertyImage::findOrFail($imageId);

            // Check if the user owns the property
            if ($image->property->agent_id !== auth()->user()->id) {
                return back()->with('error', 'You are not authorized to delete this image.');
            }

            $image->delete();
            return  redirect()->route('auth.properties.edit')->with('success', 'Image deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete image. Please try again.');
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $properties = \App\Models\Property::search($query)
            ->query(function ($builder) use ($request) {
                if ($request->filled('city')) {
                    $builder->where('city', $request->city);
                }
                // Add more filters as needed
            })
            ->paginate(12);

        return view('admin.properties.index', compact('properties', 'query'));
    }
}
