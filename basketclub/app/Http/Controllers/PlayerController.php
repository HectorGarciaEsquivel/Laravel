<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PlayerController extends Controller
{
    public function index(): JsonResponse
    {
        $players = Player::all();
        return response()->json(data: $players, status: 200);
    }

    public function show($id): JsonResponse
    {
        // Busqueda del jugador
        $player = Player::find(id: $id);
        if($player)
            return response()->json(data: $player, status: 200);
        else {
            $data = [
                'msg' => "Player not found whit id=$id",
            ];
            return response()->json(data: $data, status: 404);
        }
    }

    public function show_by_name($name): JsonResponse
    {
        // Busqueda del jugador
        $player = Player::where('first_name', $name)->first();
        if($player)
            return response()->json(data: $player, status: 200);
        else {
            $data = [
                'msg' => "Player not found whit the name=$name",
            ];
            return response()->json(data: $data, status: 404);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validate = $request->validate(rules: [
            'first_name' => 'required|max:128',
            'last_name' => 'required|max:256',
            'gender' => 'required|in:famale,male,other',
            'date_birth' => 'required|date|before_or_equal:'. Carbon::now()->subYears(value: 6),
        ]);

        // Insert new PLayer
        $player = new Player;

        $player->first_name = $validate['first_name'];
        $player->last_name  = $validate['last_name'];
        $player->gender     = $validate['gender'];
        $player->date_birth = $validate['date_birth'];

        $player->save();

        $data = ['message' => 'User created successfully', 'player' => $player];
        return response()->json(data: $data, status: 201);
    }

    public function update($id, Request $request): JsonResponse
    {
        $validate = $request->validate(rules: [
            'first_name' => 'sometimes|max:128',
            'last_name' => 'sometimes|max:256',
            'gender' => 'sometimes|in:famale,male,other',
            'date_birth' => 'sometimes|date|before_or_equal:'. Carbon::now()->subYears(value: 6),
        ]);

        // Busqueda del jugador
        $player = Player::find(id: $id);
        if($player){
            // Si la validacion es correcta actualizamos cada campo si existe
            if($request->has(key: 'first_name')) {
                $player->first_name = $validate['first_name'];
            }
            if($request->has(key: 'last_name')) {
                $player->last_name = $validate['last_name'];
            }
            if($request->has(key: 'gender')) {
                $player->gender = $validate['gender'];
            }
            if($request->has(key: 'date_birth')) {
                $player->date_birth = $validate['date_birth'];
            }
            // Guardamos los cambios
            $player->save();
            $data = ['message' => 'Upadated player successfully', 'player' => $player];
            return response()->json(data: $data, status: 200);
        }else {
            $data = [
                'msg' => "Player not found whit id=$id",
            ];
            return response()->json(data: $data, status: 404);
        }
    }

    public function destroy($id): JsonResponse
    {
        // Busqueda del jugador
        $player = Player::find(id: $id);
        if($player){
            // Eliminar jugador
            $player->delete();
            return response()->json(data: [ 'msg' => "Player with id=$id deleted",
            ], status: 200);
        }else{
            $data = [
                'msg' => "Player not found whit id=$id",
            ];
            return response()->json(data: $data, status: 404);
        }
    }
}