<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamsController;
use App\Http\Middleware\ApiForceAcceptHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Endpoint listado de players
Route::get(uri: '/players', action: [PlayerController::class, 'index'])->middleware(middleware:[ApiForceAcceptHeader::class]);

// Endpoint listado de equipos
Route::get(uri: '/teams', action: [TeamsController::class, 'index'])->middleware(middleware: [ApiForceAcceptHeader::class]);