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

    public function show($id) : JsonResponse
    {
        // Busqueda del equipo
        $team = Team::find(id: $id);
        if (!$team) {
            return response()->json(data: ['message' => 'Team not found'], status: 404);
        }
        return response()->json(data: $team, status: 200);
    }

    public function store(Request $request) : JsonResponse
    {
        $validate = $request->validate(rules: [
            'name'     => 'required|max:128',
            'category' => 'required|in:prebenjamines,benjamines,alevines,infantiles,cadete,junior,senior',
            'gender'   => 'required|in:famale,male,mixed',
        ]);

        // Insert new Team
        $team = new Team;

        $team->name     = $validate['name'];
        $team->category = $validate['category'];
        $team->gender   = $validate['gender'];

        $team->save();

        return response()->json(data: $team, status: 201);
    }

    public function update(Request $request, $id) : JsonResponse
    {
        // Busqueda del equipo
        $team = Team::find(id: $id);
        if (!$team) {
            return response()->json(data: ['message' => 'Team not found'], status: 404);
        }

        $validate = $request->validate(rules: [
            'name'     => 'sometimes|required|max:128',
            'category' => 'sometimes|required|in:prebenjamines,benjamines,alevines,infantiles,cadete,junior,senior',
            'gender'   => 'sometimes|required|in:female,male,mixed',
        ]);

        // Actualizar equipo
        $team->name     = $validate['name']     ?? $team->name;
        $team->category = $validate['category'] ?? $team->category;
        $team->gender   = $validate['gender']   ?? $team->gender;

        $team->save();

        return response()->json(data: $team, status: 200);
    }

    public function destroy($id) : JsonResponse
    {
        // Busqueda del equipo
        $team = Team::find(id: $id);
        if (!$team) {
            return response()->json(data: ['message' => 'Team not found'], status: 404);
        }

        $team->delete();
        return response()->json(data: ['message' => 'Team deleted'], status: 200);
    }
}