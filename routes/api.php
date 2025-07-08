<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriaController; // <-- ¡Asegúrate de que esta línea esté aquí!

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

