<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

Auth::routes();

Route::middleware('auth:sanctum')->group(function (){
    Route::get('user', [UserController::class, 'all']);
});

