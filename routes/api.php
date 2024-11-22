<?php

use App\Http\Controllers\AutomateExecutionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::put('update-device-token', [FcmController::class, 'updateDeviceToken']);

Route::post('send', [AutomateExecutionController::class, 'index']);
// Route::post('send', [FcmController::class, 'sendFcmNotification']);
