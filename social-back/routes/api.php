<?php

use App\Models\User;
use App\Models\Conteudo;
use \Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ConteudoController;

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


Route::post('/login', [UsuarioController::class, 'login']);
Route::post('/cadastro', [UsuarioController::class, 'cadastro']);

Route::middleware('auth:api')->get('/user', [UsuarioController::class, 'usuario']);
Route::middleware('auth:api')->put('/perfil', [UsuarioController::class, 'perfil']);
Route::middleware('auth:api')->get('/usuario/amigos', [UsuarioController::class, 'listar']);
Route::middleware('auth:api')->post('/usuario/add_amigo', [UsuarioController::class, 'seguir']);
Route::middleware('auth:api')->get('/usuario/amigos/{id}', [UsuarioController::class, 'amigos']);

Route::middleware('auth:api')->get('/conteudo/listar', [ConteudoController::class, 'listar']);
Route::middleware('auth:api')->put('/conteudo/curtir/{id}', [ConteudoController::class, 'curtir']);
Route::middleware('auth:api')->put('/conteudo/curtirpagina/{id}', [ConteudoController::class, 'paginaCurtir']);
Route::middleware('auth:api')->post('/conteudo/adicionar', [ConteudoController::class, 'adicionar']);
Route::middleware('auth:api')->put('/conteudo/comentar/{id}', [ConteudoController::class, 'comentar']);
Route::middleware('auth:api')->put('/conteudo/comentarpagina/{id}', [ConteudoController::class, 'paginaComentar']);
Route::middleware('auth:api')->get('/conteudo/pagina/listar/{id}', [ConteudoController::class, 'pagina']);

