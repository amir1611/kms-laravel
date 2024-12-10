<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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
Route::post('/staff', [UserController::class, 'storeStaff']);

// View Users
Route::get('/users', [UserController::class, 'viewUsers']);

// Delete User
Route::delete('/users/{id}', [UserController::class, 'destroy']);