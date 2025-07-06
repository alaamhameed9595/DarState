<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Models\Feature;
use App\Models\Property;
use App\Services\TelegramService;
use Cloudinary\Api\Upload\UploadApi;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index(Request $request)
    {

        $query = Property::query()->where('status', 'available')->where('is_published', true);
        $q = $request->input('q');
        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%$q%")
                    ->orWhere('city', 'like', "%$q%")
                    ->orWhere('type', 'like', "%$q%")
                    ->orWhere('address', 'like', "%$q%")
                    ->orWhere('state', 'like', "%$q%")
                    ->orWhere('country', 'like', "%$q%")
                    ->orWhere('process_type', 'like', "%$q%")

                ;
            });
        }
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '>=', $request->bedrooms);
        }
        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', '>=', $request->bathrooms);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('area_max')) {
            $query->where('size', '<=', $request->area_max);
        }
        if ($request->filled('area_min')) {
            $query->where('size', '>=', $request->area_min);
        }
        $properties = $query->with('images')->paginate(12);
        // return $properties;
        $cities = Property::select('city')->distinct()->pluck('city');
        $types = Property::select('type')->distinct()->pluck('type');
        $statuses = Property::select('status')->distinct()->pluck('status');
        $countries = Property::select('country')->distinct()->pluck('country');
        $features = Feature::all();
        $bedrooms = Property::select('bedrooms')->distinct()->pluck('bedrooms');
        $bathrooms = Property::select('bathrooms')->distinct()->pluck('bathrooms');
        // $areas = Property::select('size')->distinct()->pluck('size');
        return view('website.index', compact(['properties', 'cities', 'types', 'statuses', 'countries', 'features', 'bedrooms', 'bathrooms']));
    }

        public function show($id)
    {
        $property = Property::with('features', 'agent', 'inquiries')->findOrFail($id);
        return view('admin.properties.show', compact('property'));
    }

    // Agent management views
    public function manage(Request $request)
    {
        $properties = Property::where('agent_id', auth()->user()->id)->paginate(15);
        $cities = Property::select('city')->distinct()->pluck('city');
        $types = Property::select('type')->distinct()->pluck('type');
        $statuses = Property::select('status')->distinct()->pluck('status');
        $countries = Property::select('country')->distinct()->pluck('country');
        $q = $request->input('q');
        $type = $request->input('type');
        $status = $request->input('status');
        $city = $request->input('city');
        $country = $request->input('country');
        $price_min = $request->input('price_min');
        $price_max = $request->input('price_max');
        $bedrooms = $request->input('bedrooms');
        $bathrooms = $request->input('bathrooms');
        $area = $request->input('area');
        $query = Property::query();
        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%$q%")
                    ->orWhere('city', 'like', "%$q%")
                    ->orWhere('type', 'like', "%$q%")
                    ->orWhere('address', 'like', "%$q%")
                    ->orWhere('state', 'like', "%$q%")
                    ->orWhere('country', 'like', "%$q%")
                    ->orWhere('process_type', 'like', "%$q%")

                ;
            });
        }
        if ($type) {
            $query->where('type', $type);
        }
        if ($bedrooms !== null && $bedrooms !== '') {
            $query->where('bedrooms', $bedrooms);
        }
        if ($bathrooms !== null && $bathrooms !== '') {
            $query->where('bathrooms', $bathrooms);
        }
        if ($area !== null && $area !== '') {
            $query->where('size', '>=', $area);
        }
        if ($status) {
            $query->where('status', $status);
        }
        if ($city) {
            $query->where('city', $city);
        }
        if ($country) {
            $query->where('country', $country);
        }
        if ($price_min !== null && $price_min !== '') {
            $query->where('price', '>=', $price_min);
        }
        if ($price_max !== null && $price_max !== '') {
            $query->where('price', '<=', $price_max);
        }
        $properties = $query->paginate(12)->appends($request->except('page'));
        if ($request->ajax()) {
            return view('admin.properties.index', compact('properties', 'cities', 'types', 'statuses', 'countries'))->render();
        }
        return view('admin.properties.index', compact('properties', 'cities', 'types', 'statuses', 'countries'));
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
    public function publish($id, TelegramService $telegram)
    {
        $property = Property::findOrFail($id,);
        if (!Auth::user()->can('publish properties')) {
            return back()->with('error', 'You are not authorized to publish this property.');
        }
        $message = "🏡 *عقار جديد:*\n"
            . "*{$property->title}*\n"
            . "📍 الموقع: {$property->address}\n"
            . "💰 السعر: {$property->price}\n"
            . ")";

        $sent = $telegram->sendMessage($message);
        if (!$sent) {
            Log::warning('Telegram message failed to send for property ID: ' . $property->id);
            // Optionally, flash a warning to the user:
            return back()
                ->withInput()
                ->with('Telegram notification failed.');

            // session()->flash('warning', 'Property created, but Telegram notification failed.');
        } else {
            $property->is_published = true;
            Log::info('Telegram message sent successfully for property ID: ' . $property->id);
            $property->save();
            return redirect()->back()->with('success', 'Property published successfully!');
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
        $q = $request->input('q');
        $type = $request->input('type');
        $status = $request->input('status');
        $query = Property::query();
        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%$q%")
                    ->orWhere('city', 'like', "%$q%")
                    ->orWhere('type', 'like', "%$q%")
                    ->orWhere('address', 'like', "%$q%")
                    ->orWhere('state', 'like', "%$q%")
                    ->orWhere('country', 'like', "%$q%")
                    ->orWhere('status', 'like', "%$q%")
                    ->orWhere('price', 'like', "%$q%")
                    ->orWhere('bedrooms', 'like', "%$q%")
                    ->orWhere('bathrooms', 'like', "%$q%")
                    ->orWhere('year_built', 'like', "%$q%")
                    ->orWhere('process_type', 'like', "%$q%")
                ;
            });
        }
        if ($type) {
            $query->where('type', $type);
        }
        if ($status) {
            $query->where('status', $status);
        }
        $properties = $query->limit(100)->get();
        return response()->json($properties);
    }

    public function map(Request $request)
    {

        $properties = json_decode(urldecode($request->query('payload')), true);

        //$properties = Property::where('agent_id', auth()->user()->id)->where('status', 'available')->get();
        return view('admin.properties.map', compact('properties'));
    }
    function about()
    {
        $properties = Property::where('status', 'available')->where('is_published', true)->take(4)->with('images')->get();
        return view('website.about', compact('properties'));
    }

    public function faq()
    {
        return view('website.faq');
    }
    public function contact()
    {
        return view('website.contact');
    }
    public function blog()
    {
        $properties = Property::where('status', 'available')->where('is_published', true)->take(4)->with('images')->get();

        return view('website.blog', compact('properties'));
    }

    public function property($id)
    {
        $property = Property::with('images', 'features','agent')->findOrFail($id);
        $relatedProperties = Property::where('id', '!=', $id)
            ->where('status', 'available')
            ->where('is_published', true)
            ->take(4)
            ->with('images')
            ->get();

        return view('website.property', compact('property', 'relatedProperties'));
    }
}
