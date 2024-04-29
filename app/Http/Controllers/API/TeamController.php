<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $team = auth()->user()->team->load('users');
        return new TeamResource($team);
    }
}
