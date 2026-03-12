<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnnonceController;

Route::get('/annonces', [AnnonceController::class, 'index']);
Route::get('/annonces/{id}', [AnnonceController::class, 'show']);
Route::post('/annonces', [AnnonceController::class, 'store']);
Route::put('/annonces/{id}', [AnnonceController::class, 'update']);
Route::delete('/annonces/{id}', [AnnonceController::class, 'destroy']);
