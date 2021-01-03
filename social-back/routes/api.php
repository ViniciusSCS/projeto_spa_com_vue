<?php


use \Illuminate\Http\Request;
use \Illuminate\Validation\Rule;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UsuarioController;

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


Route::post('/cadastro', [UsuarioController::class, 'cadastro']);

Route::post('/login', [UsuarioController::class, 'login']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->put('/perfil', [UsuarioController::class, 'perfil']);
