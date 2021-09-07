<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CircunscripcionController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('login-social', [AuthController::class, 'loginSocial']);

Route::post('check-unique-cuenta-usuario', [AuthController::class, 'checkUniqueCuentaUsuario']);
Route::post('check-unique-email-usuario', [AuthController::class, 'checkUniqueEmailUsuario']);

Route::post('register', [AuthController::class, 'register']);
Route::post('register-verify', [AuthController::class, 'registerVerify']);

/**
 * CIRCUNSCRIPCIONES
 */

Route::get('get-circunscripciones', [CircunscripcionController::class, 'getCircunscripciones']);
Route::get('get-localidades-circunscripcion/{id}', [CircunscripcionController::class, 'getLocalidadesCircunscripcion']);


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::post('get-user', [AuthController::class, 'getUser']);
    Route::post('send-email-confirm', [AuthController::class, 'sendEmailConfirm']);



});


Route::get('user-download/{id}/{filename?}', [AuthController::class, 'download']);
