<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AnnonceController;
use App\Http\Controllers\Api\AuthController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/annonces', [AnnonceController::class, 'index']);
Route::get('/annonces/{id}', [AnnonceController::class, 'show']);
Route::get('/categories', [AnnonceController::class, 'categories']);



Route::middleware('auth:sanctum')->group(function () {

    // test utilisateur connecté
    Route::get('/me', function (Request $request) {
        return response()->json([
            'user' => $request->user()
        ]);
    });

    // création annonce
    Route::post('/annonces', [AnnonceController::class, 'store']);

    // modification annonce
    Route::put('/annonces/{id}', [AnnonceController::class, 'update']);

    // suppression annonce
    Route::delete('/annonces/{id}', [AnnonceController::class, 'destroy']);
});