<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlimentosController;
use App\Http\Controllers\DietasController;

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

Route::resource('user', UserController::class);

Route::resource('alimento', AlimentosController::class);

Route::resource('dieta', DietasController::class);

Route::get('user/perfil/{id}', [UserController::class, 'indexOne']);

Route::get('alimento/modificar/{id}', [AlimentosController::class, 'indexOne']);

Route::get('dieta/modificar/{id}', [DietasController::class, 'indexOne']);

Route::post('user/login', [UserController::class, 'login']);

Route::get('dieta/listar/{id}', [DietasController::class, 'listarDietasPorUsuario']);

Route::get('alimento/listar/{id}', [AlimentosController::class, 'listarAlimentosPorUsuario']);
