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

Route::middleware('auth:api')->get('/conteudo/listar', [ConteudoController::class, 'listar']);
Route::middleware('auth:api')->put('/conteudo/curtir/{id}', [ConteudoController::class, 'curtir']);
Route::middleware('auth:api')->post('/conteudo/adicionar', [ConteudoController::class, 'adicionar']);
Route::middleware('auth:api')->put('/conteudo/comentar/{id}', [ConteudoController::class, 'comentar']);

Route::get('/testes', function () {

    /*Exemplo de adicionar Amigos*/

//    $user2 = User::find(2);
//    $user->amigos()->toggle($user2->id);
//    return $user->amigos;

});
