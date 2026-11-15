<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//equipments
Route::get('/equipments', [\App\Http\Controllers\EquipmentController::class, 'index']);
//moyenne
Route::get('/averageRentalPrice/{equipment_id}',[\App\Http\Controllers\EquipmentController::class, 'averageRentalPrice']);
// popularite
Route::get('/equipments/{id}/popularite',[\App\Http\Controllers\EquipmentController::class,'popularite']);

//locationa
Route::get('/rental/{user_id}', [\App\Http\Controllers\RentalController::class, 'locationParUtilisateur']);

//utilisateurs
Route::post('/users/create', [\App\Http\Controllers\UserController::class, 'store']);
Route::put('/users/update/{id}', [\App\Http\Controllers\UserController::class, 'update']);

//critiques
Route::delete('/reviews/delete/{id}', [\App\Http\Controllers\ReviewController::class, 'destroy']);


