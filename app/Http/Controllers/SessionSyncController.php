<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionSyncController extends Controller
{
    public function store(Request $request)
    {
        $key = $request->key;
        $value = json_decode($request->value, true); // decode if it's a JSON string

        if ($key === 'user_location') {
            session([
                'lat' => $value['latitude'],
                'long' => $value['longitude']
            ]);
        }

        return response()->json(['message' => 'Session synced']);
    }
}
