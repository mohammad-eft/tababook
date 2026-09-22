<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sendCode', [UserController::class, 'sendCode']);
Route::post('/removeActivationCode', [UserController::class, 'removeActivationCode']);
Route::post('/checkCode', [UserController::class, 'checkCode']);
Route::post('/checkPassKey', [UserController::class, 'checkPassKey']);
Route::post('/sendActivationCode', [UserController::class, 'sendActivationCode']);
Route::post('/getFilters', [SearchController::class, 'getFilters']);