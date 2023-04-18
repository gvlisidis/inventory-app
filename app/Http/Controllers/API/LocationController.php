<?php

namespace App\Http\Controllers\API;

use App\Enums\Location;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    public function index()
    {
        return new LocationResource(Location::getAllValues());
    }
}
