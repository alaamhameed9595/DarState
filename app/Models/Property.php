<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Property extends Model
{
    use HasFactory, Searchable;
    protected $fillable = [
        'title',
        'description',
        'address',
        'city',
        'state',
        'country',
        'zipcode',
        'latitude',
        'longitude',
        'price',
        'type',
        'status',
        'bedrooms',
        'bathrooms',
        'size',
        'year_built',
        'agent_id',
        'process_type'
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'property_feature');
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zipcode' => $this->zipcode,
            'price' => $this->price,
            'type' => $this->type,
            'status' => $this->status,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'size' => $this->size,
            'year_built' => $this->year_built,
        ];
    }
}
