<?php

namespace App\Http\Controllers;

use \App\Services;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Http\Request;

class BotManController extends Controller
{


    public function handle()
    {
        $botman = app('botman');

        $botman->hears('hello', function ($bot) {
            $bot->reply('Hey there! 👋 What can I help you with?');
        });

        $botman->hears('your name', function ($bot) {
            $bot->reply('I’m BotMan, your Laravel companion!');
        });

        $locationService = app(\App\Services\LocationService::class);

        //Location-based property search using session location: "nearby"
        $botman->hears('nearby', function ($bot) {
            $locationService = app(\App\Services\LocationService::class);
            $location = $locationService->get();
            $lat = $location['lat'] ?? 0;
            $lon = $location['lng'] ?? 0;
            $radius = 0.05;
            $latMin = $lat - $radius;
            $latMax = $lat + $radius;
            $lonMin = $lon - $radius;
            $lonMax = $lon + $radius;

            $nearby = \App\Models\Property::whereBetween('latitude', [$latMin, $latMax])
                ->whereBetween('longitude', [$lonMin, $lonMax])
                ->get();

            if ($nearby->isEmpty()) {
                $bot->reply('No properties found nearby. Try sending your location again!');
            } else {
                $reply = "Nearby properties (" . $lat . ", " . $lon . "):\n";
                foreach ($nearby as $property) {
                    $mapUrl = "https://www.openstreetmap.org/?mlat={$property->latitude}&mlon={$property->longitude}#map=17/{$property->latitude}/{$property->longitude}";
                    $reply .= "\n - <a href='{{route('website.property',$property->id)}}>{$property->title}</a> ( <a href='$mapUrl' target='_blank'>Map</a> )\n";
                }
                $bot->reply($reply);
            }
        });

        $botman->listen();
    }
}
