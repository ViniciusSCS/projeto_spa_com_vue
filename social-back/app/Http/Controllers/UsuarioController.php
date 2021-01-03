<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if ($validacao->fails()) {
            return $validacao->errors();
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = auth()->user();
            $user->imagem = asset($user->imagem);
            $user->token = $user->createToken($user->email)->accessToken;
            return $user;

        } else {
            return ['status' => false];
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cadastro(Request $request)
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validacao->fails()) {
            return $validacao->errors();
        }

        $imagem = '/img/avatar.png';

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'imagem' => $imagem,
        ]);

        $user->imagem = asset($user->imagem);
        $user->token = $user->createToken($user->email)->accessToken;

        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function perfil(Request $request)
    {

        $user = $request->user();
        $data = $request->all();
        if (isset($data['password'])) {
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

            if ($validacao->fails()) {
                return $validacao->errors();
            }

            $user->password = bcrypt($data['password']);
            $user->description_user = $data['description_user'];

        } else {
            $validacao = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user->id)
                ],
                'photo' => 'mimes:jpg, png, jpeg',
            ]);

            if ($validacao->fails()) {
                return $validacao->errors();
            }


            $user->name = $data['name'];
            $user->email = $data['email'];

            if (isset($user->description_user))
                $user->description_user = $data['description_user'];
            else
                $user->description_user = '';
        }

        //Trata imagem
        if (isset($data['imagem'])) {

            Validator::extend('base64imagem', function ($attribute, $value, $parameters, $validator) {
                $explode = explode(',', $value);
                $allow = [
                    'jpg',
                    'png',
                    'jpeg',
                    'svg',
                ];
                $format = str_replace(
                    [
                        'data:image/',
                        ';',
                        'base64',
                    ],
                    [
                        '', '', '',
                    ],
                    $explode[0]
                );

                if (!in_array($format, $allow)) {
                    return false;
                }
                if (!preg_match('%[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
                    return false;
                }

                return true;
            });


            $validacao = Validator::make($data, [
                'imagem' => 'base64imagem',
            ], ['base64imagem' => 'Imagem inválida']);

            if ($validacao->fails()) {
                return $validacao->errors();
            }


            $nameImg = time();
            $diretorioPai = 'profiles';
            $diretorioImagem = $diretorioPai . DIRECTORY_SEPARATOR . 'profile_id_' . $user->id;
            $ext = substr($data['imagem'], 11, strpos($data['imagem'], ';') - 11);
            $urlImagem = $diretorioImagem . DIRECTORY_SEPARATOR . $nameImg . '.' . $ext;

            $file = str_replace('data:image/' . $ext . ';base64,', '', $data['imagem']);
            $file = base64_decode($file);

            if (!file_exists($diretorioPai)) {
                mkdir($diretorioPai, 0700);
            }
            if ($user->imagem) {
                if (file_exists($user->imagem)) {
                    unlink($user->imagem);
                }
            }

            if (!file_exists($diretorioImagem)) {
                mkdir($diretorioImagem, 0700);
            }

            file_put_contents($urlImagem, $file);

            $user->imagem = $urlImagem;

        }


        $user->save();

        $user->imagem = asset($user->imagem);
        $user->token = $user->createToken($user->email)->accessToken;
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function usuario(Request $request)
    {
        return $request->user();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
