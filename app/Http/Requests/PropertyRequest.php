<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Property;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // For updates, check if the user owns the property
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $propertyId = $this->route('id');
            if ($propertyId) {
                $property = Property::find($propertyId);
                return $property && $property->agent_id === auth()->user()->id;
            }
        }

        return true; // Authorization is handled by middleware for other cases
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $titleRule = 'required|string|max:255|min:3';
        return [
            'title' => $titleRule,
            'process_type' => 'required|in:0,1',
            'description' => 'required|string|max:1000|min:10',
            'price' => 'required|numeric|min:0|max:999999999.99',
            'type' => 'required|in:apartment,house,villa,cottage,land',
            'status' => 'required|in:available,sold,pending,rented',
            'address' => 'required|string|max:255|min:5',
            'city' => 'required|string|max:100|min:2',
            'state' => 'required|string|max:100|min:2',
            'country' => 'required|string|max:100|min:2',
            'zipcode' => 'required|string|max:20|min:3',
            'bedrooms' => 'nullable|integer|min:0|max:20',
            'bathrooms' => 'nullable|integer|min:0|max:20',
            'size' => 'nullable|integer|min:1|max:999999',
            'year_built' => 'nullable|integer|min:1800|max:' . (date('Y') + 5),
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'features' => 'nullable|array|max:20',
            'features.*' => 'exists:features,id',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120|dimensions:min_width=200,min_height=100',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Property title is required.',
            'title.min' => 'Property title must be at least 3 characters.',
            'title.max' => 'Property title cannot exceed 255 characters.',
            'process_type.required' => 'Please select whether this is for rent or sale.',
            'process_type.in' => 'Please select a valid transaction type.',
            'description.required' => 'Property description is required.',
            'description.min' => 'Property description must be at least 10 characters.',
            'description.max' => 'Property description cannot exceed 1000 characters.',
            'price.required' => 'Property price is required.',
            'price.numeric' => 'Property price must be a valid number.',
            'price.min' => 'Property price must be greater than 0.',
            'price.max' => 'Property price cannot exceed $999,999,999.99.',
            'type.required' => 'Property type is required.',
            'type.in' => 'Please select a valid property type.',
            'status.required' => 'Property status is required.',
            'status.in' => 'Please select a valid property status.',
            'address.required' => 'Property address is required.',
            'address.min' => 'Property address must be at least 5 characters.',
            'address.max' => 'Property address cannot exceed 255 characters.',
            'city.required' => 'City is required.',
            'city.min' => 'City name must be at least 2 characters.',
            'city.max' => 'City name cannot exceed 100 characters.',
            'state.required' => 'State is required.',
            'state.min' => 'State name must be at least 2 characters.',
            'state.max' => 'State name cannot exceed 100 characters.',
            'country.required' => 'Country is required.',
            'country.min' => 'Country name must be at least 2 characters.',
            'country.max' => 'Country name cannot exceed 100 characters.',
            'zipcode.required' => 'Zip code is required.',
            'zipcode.min' => 'Zip code must be at least 3 characters.',
            'zipcode.max' => 'Zip code cannot exceed 20 characters.',
            'bedrooms.integer' => 'Number of bedrooms must be a whole number.',
            'bedrooms.min' => 'Number of bedrooms cannot be negative.',
            'bedrooms.max' => 'Number of bedrooms cannot exceed 20.',
            'bathrooms.integer' => 'Number of bathrooms must be a whole number.',
            'bathrooms.min' => 'Number of bathrooms cannot be negative.',
            'bathrooms.max' => 'Number of bathrooms cannot exceed 20.',
            'size.integer' => 'Property size must be a whole number.',
            'size.min' => 'Property size must be greater than 0.',
            'size.max' => 'Property size cannot exceed 999,999 sq ft.',
            'year_built.integer' => 'Year built must be a whole number.',
            'year_built.min' => 'Year built cannot be earlier than 1800.',
            'year_built.max' => 'Year built cannot be in the future.',
            'latitude.numeric' => 'Latitude must be a valid number.',
            'latitude.between' => 'Latitude must be between -90 and 90 degrees.',
            'longitude.numeric' => 'Longitude must be a valid number.',
            'longitude.between' => 'Longitude must be between -180 and 180 degrees.',
            'features.array' => 'Features must be selected as a list.',
            'features.max' => 'Cannot select more than 20 features.',
            'features.*.exists' => 'One or more selected features are invalid.',
            'images.array' => 'Images must be uploaded as files.',
            'images.max' => 'Cannot upload more than 10 images.',
            'images.*.image' => 'Uploaded files must be images.',
            'images.*.mimes' => 'Images must be in JPEG, PNG, JPG, or GIF format.',
            'images.*.max' => 'Each image must be smaller than 5MB.',
            'images.*.dimensions' => 'Each image must be at least 300x200 pixels.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'property title',
            'description' => 'property description',
            'price' => 'property price',
            'type' => 'property type',
            'status' => 'property status',
            'address' => 'property address',
            'city' => 'city',
            'state' => 'state',
            'country' => 'country',
            'zipcode' => 'zip code',
            'bedrooms' => 'number of bedrooms',
            'bathrooms' => 'number of bathrooms',
            'size' => 'property size',
            'year_built' => 'year built',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            'features' => 'property features',
            'images' => 'property images',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Check if property title is unique for the current user
            if ($this->has('title')) {
                $query = Property::where('title', $this->title)
                    ->where('agent_id', auth()->user()->id);

                // Exclude current property if updating
                if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
                    $propertyId = $this->route('id');
                    if ($propertyId) {
                        $query->where('id', '!=', $propertyId);
                    }
                }

                if ($query->exists()) {
                    $validator->errors()->add('title', 'You already have a property with this title.');
                }
            }
        });
    }
}
