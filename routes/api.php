<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Store Staff
Route::post('/staff', [UserController::class, 'storeStaff'])->middleware('auth:sanctum');

// View Users
Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');

// Delete User
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum');