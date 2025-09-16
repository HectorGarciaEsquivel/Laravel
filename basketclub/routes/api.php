<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamsController;
use App\Http\Middleware\ApiForceAcceptHeader;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::middleware([ApiForceAcceptHeader::class])->group(callback: function (): void{
    // Endpoint listado de players
    Route::get(uri: '/players', action: [PlayerController::class, 'index']);
    // Endopiont jugador por Id
    Route::get(uri: '/players/{id}', action: [PlayerController::class, 'show']);
    // Endopiont jugador por Nombre
    Route::get(uri: '/players/name/{name}', action: [PlayerController::class, 'show_by_name']);
    // Endpoint creación de jugadores
    Route::post(uri: '/players', action: [PlayerController::class, 'store']);
    // Endopoint actualizacion de jugadores
    Route::put(uri: '/players/{id}', action: [PlayerController::class, 'update']);
    // Endopoint eliminar de jugadores
    Route::delete(uri: '/players/{id}', action: [PlayerController::class, 'destroy']);
});

// Endpoint listado de equipos
Route::get(uri: '/teams', action: [TeamsController::class, 'index'])->middleware(middleware: [ApiForceAcceptHeader::class]);