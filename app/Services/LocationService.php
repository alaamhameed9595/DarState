<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class LocationService
{
    public function get()
    {
        return [
            'lat' => session('lat'),
            'lng' => session('long')
        ];
    }

    public function set($lat, $lng)
    {
        session([
            'lat' => $lat,
            'long' => $lng
        ]);
    }
}
