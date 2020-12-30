<?php

use \App\Models\User;
use \Illuminate\Http\Request;
use \Illuminate\Validation\Rule;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Facades\Validator;

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


Route::post('/cadastro', function (Request $request){
    $data = $request->all();

    $validacao = Validator::make($data, [
       'name' => 'required|string|max:255',
       'email' => 'required|string|email|max:255|unique:users',
       'password' => 'required|string|min:6|confirmed',
    ]);

    if($validacao->fails()){
        return $validacao->errors();
    }

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
    ]);

    $user->token = $user->createToken($user->email)->accessToken;

    return $user;
});

Route::post('/login', function (Request $request){
    $data = $request->all();

    $validacao = Validator::make($data, [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string',
    ]);

    if($validacao->fails()){
        return $validacao->errors();
    }

    if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
        $user = auth()->user();
        $user->token = $user->createToken($user->email)->accessToken;
        return $user;

    }else{
        return ['status' => false];
    }
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->put('/perfil', function (Request $request) {

    $user = $request->user();
    $data = $request->all();
    if(isset($data['password'])){
        $validacao = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validacao->fails()){
            return $validacao->errors();
        }

        $user->password = bcrypt($data['password']);
        $user->description_user = $data['description_user'];

    }else{
        $validacao = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
        ]);

        if($validacao->fails()){
            return $validacao->errors();
        }


        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->description_user = $data['description_user'];
    }

    //Trata imagem
    if(isset($data['imagem'])){
        $nameImg = time();
        $diretorioPai = 'profiles';
        $diretorioImg =  $diretorioPai.DIRECTORY_SEPARATOR.'profile_id_'.$user->id;
        $ext = substr($data['imagem'], 11, strpos($data['imagem'], ';') -11);

        $urlImagem = $diretorioImg.DIRECTORY_SEPARATOR.$nameImg.'.'.$ext;

        $file = str_replace('data:imagem/'.$ext.';base64,', '', $data['imagem']);

        $file = base64_decode($file);

        Storage::put($urlImagem, $file);

        $user->imagem = $urlImagem;

    }


    $user->save();

    $user->imagem = asset($user->imagem);
    $user->token = $user->createToken($user->email)->accessToken;
    return $user;
});
