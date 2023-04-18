<?php

namespace App\Http\Controllers\API;

use App\Enums\Group;
use App\Enums\Location;
use App\Http\Controllers\Controller;
use App\Http\Resources\GroupResource;
use App\Http\Resources\LocationResource;

class GroupController extends Controller
{
    public function index()
    {
        return new GroupResource(Group::getAllValues());
    }
}
