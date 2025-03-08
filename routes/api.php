<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Carbon\Carbon;

Route::prefix('user')->group(function () {
    Route::get('/', function () {
        $date = Carbon::now()->setTimezone('GMT-3');

        return "Health Check | $date";
    });

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:api')->get('me', [AuthController::class, 'me']);
    Route::middleware('auth:api')->post('logout', [AuthController::class, 'logout']);
});

Route::prefix('to-do-list')
->middleware('auth:api')
->group(function () {
    Route::get('/', function () {
        return 'API Task List';
    });
});
