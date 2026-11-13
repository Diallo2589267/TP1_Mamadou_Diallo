<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//equipments
Route::get('/equipments', [\App\Http\Controllers\EquipmentController::class, 'index']);

//locationa
Route::get('/rental/{user_id}', [\App\Http\Controllers\RentalController::class, 'show']);

//utilisateurs
Route::post('/users/create', [\App\Http\Controllers\UserController::class, 'store']);
Route::put('/users/update/{id}', [\App\Http\Controllers\UserController::class, 'update']);

//critiques
Route::delete('/reviews/delete/{id}', [\App\Http\Controllers\ReviewController::class, 'destroy']);

// popularite
Route::get('/indice_popularite',[\App\Http\Controllers\EquipmentController::class,'popularite']);

//moyenne
Route::get('/moyenne_prix_total',[\App\Http\Controllers\EquipmentController::class, 'moyenne']);