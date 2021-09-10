<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CircunscripcionController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\PersonaController;


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

/**
UBICACIONES
 */

Route::get('get-departamentos', [UbicacionController::class, 'getDepartamentos']);


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::post('get-user', [AuthController::class, 'getUser']);
    Route::post('send-email-confirm', [AuthController::class, 'sendEmailConfirm']);

    Route::get('get-permisos-url-user', [AuthController::class,'getPermisosUrlUser']);

    /**
     * EVENTOS
    */
    Route::post('paginate-eventos', [EventoController::class, 'paginateEventos']);
    Route::get('get-eventos', [EventoController::class, 'getEventos']);
    Route::get('show-evento/{id}', [EventoController::class, 'showEvento']);

    /**
    PERSONA
     */
    Route::post('paginate-personas', [PersonaController::class, 'paginatePersonas']);
    Route::post('store-observacion-persona/{id}/{idevento}', [PersonaController::class, 'storeObservacionPersona']);
    Route::get('show-persona/{id}/{idevento}', [PersonaController::class, 'showPersonaEvento']);
    Route::get('aprobar-persona/{id}/{idevento}', [PersonaController::class, 'aprobarPersona']);
    Route::get('rechazar-persona/{id}/{idevento}', [PersonaController::class, 'rechazarPersona']);
    Route::post('save-cargo-persona-evento/{id}/{idevento}', [PersonaController::class, 'saveCargoPersonaEvento']);
    Route::post('save-observacion-persona-evento/{id}/{idevento}', [PersonaController::class, 'saveObservacionPersonaEvento']);
    Route::post('save-titular-persona-evento/{id}/{idevento}', [PersonaController::class, 'saveTitularPersonaEvento']);
    Route::post('store-persona', [PersonaController::class, 'storePersona']);
    Route::get('show-inscritos-evento/{id}', [PersonaController::class, 'showInscritosEvento']);

});


Route::get('user-download/{id}/{filename?}', [AuthController::class, 'download']);
Route::get('persona-foto-download/{id}/{filename?}', [PersonaController::class, 'download']);

Route::post('show-persona-info', [PersonaController::class, 'showPersonaEventoInfo']);
