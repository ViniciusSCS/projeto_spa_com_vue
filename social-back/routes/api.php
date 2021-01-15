<?php

use App\Models\User;
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
Route::middleware('auth:api')->post('/conteudo/adicionar', [ConteudoController::class, 'adicionar']);

//Route::get('/testes', function () {
//    $user = User::find(1);

    /*Exemplo de adicionar Conteúdo*/

//    $user->conteudos()->create([
//        'data' => date('2021-01-11'),
//        'link' => 'Aqui o Link',
//        'texto' => 'Aqui o texto',
//        'titulo' => 'Conteudo 3',
//        'imagem' => 'URL da imagem',
//    ]);

//    return $user->conteudos;

    /*Exemplo de adicionar Amigos*/

//    $user2 = User::find(2);
//    $user->amigos()->toggle($user2->id);
//    return $user->amigos;

    /*Exemplo de adicionar Comentários*/


    /*Exemplo de adicionar Curtidas*/

//    $conteudo = Conteudo::find(1);

//    $user->curtidas()->toggle($conteudo->id);

//    return $conteudo->curtidas();
//    return $conteudo->curtidas()->count();

    /*Exemplo de adicionar Comentários*/

//    $user2 = User::find(2);
//    $conteudo = Conteudo::find(2);
//    $user->comentarios()->create([
//        'data' => date('Y-m-d'),
//        'texto' => 'Sucesso',
//        'conteudo_id' => $conteudo->id,
//    ]);

//    $user2->comentarios()->create([
//        'data' => date('Y-m-d'),
//        'texto' => 'Muito Bom!',
//        'conteudo_id' => $conteudo->id,
//    ]);

//    return $conteudo->comentarios;
//});
