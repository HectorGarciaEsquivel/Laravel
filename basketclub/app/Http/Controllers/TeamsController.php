<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function index() : JsonResponse
    {
        $teams = Team::all();
        return response()->json(data: $teams, status: 200);
    }
}