<?php

namespace App\Http\Controllers;

use App\Models\{
    User,
    Conteudo
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConteudoController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listar(Request $request)
    {
        $user = $request->user();
        $amigos = $user->amigos()->pluck('id');
        $amigos->push($user->id);

        $conteudos = Conteudo::with('user')
            ->whereIn('user_id', $amigos)
            ->orderBy('data', 'desc')
            ->paginate(5);


        foreach ($conteudos as $key => $conteudo) {
            $conteudo->total_curtidas = $conteudo->curtidas()->count();
            $conteudo->comentarios = $conteudo->comentarios()->with('user')->orderBy('data', 'desc')->get();
            $curtiu = $user->curtidas()->find($conteudo->id);

            if ($curtiu)
                $conteudo->curtiu_conteudo = true;
            else
                $conteudo->curtiu_conteudo = false;
        }

        return ['status' => true, "conteudos" => $conteudos];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adicionar(Request $request)
    {
        $data = $request->all();

        // validação
        $validacao = Validator::make($data, [
            'texto' => 'required|string',
        ]);

        if ($validacao->fails()) {
            return ['status' => false, 'validacao' => true, "erros" => $validacao->errors()];
        }

        $conteudo = new Conteudo();

        $conteudo->link = $data['link'];
        $conteudo->texto = $data['texto'];
        $conteudo->imagem = $data['imagem'];
        $conteudo->user_id = $data['usuario']['id'];
        $conteudo->data = date('Y-m-d H:i:s');

        $conteudo->save();

        $conteudos = Conteudo::with('user')
            ->orderBy('data', 'desc')
            ->paginate(5);

        return ['status' => true, "conteudos" => $conteudos];

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function curtir($id, Request $request)
    {

        $conteudo = Conteudo::find($id);

        if ($conteudo) {
            $user = $request->user();
            $user->curtidas()->toggle($conteudo->id);
            return [
                'status' => true,
                'lista' => $this->listar($request),
                "curtidas" => $conteudo->curtidas()->count(),
            ];
        } else
            return ['status' => false, "erro" => 'Conteudo não existe'];


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function paginaCurtir($id, Request $request)
    {

        $conteudo = Conteudo::find($id);

        if ($conteudo) {
            $user = $request->user();
            $user->curtidas()->toggle($conteudo->id);
            return [
                'status' => true,
                'lista' => $this->pagina($request, $conteudo->user_id),
                "curtidas" => $conteudo->curtidas()->count(),
            ];
        } else
            return ['status' => false, "erro" => 'Conteudo não existe'];


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function comentar($id, Request $request)
    {
        $conteudo = Conteudo::find($id);
        if ($conteudo){
            $user = $request->user();
            $user->comentarios()->create([
                'data' => date('Y-m-d H:i:s'),
                'texto' => $request->texto,
                'conteudo_id' => $conteudo->id,
            ]);
            return [
                'status' => true,
                'lista' => $this->listar($request),
            ];

            return $conteudo->comentarios;

        }else
            return ['status' => false, "erro" => 'Conteudo não existe'];


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function paginaComentar($id, Request $request)
    {
        $conteudo = Conteudo::find($id);
        if ($conteudo){
            $user = $request->user();
            $user->comentarios()->create([
                'data' => date('Y-m-d H:i:s'),
                'texto' => $request->texto,
                'conteudo_id' => $conteudo->id,
            ]);
            return [
                'status' => true,
                'lista' => $this->pagina($request, $conteudo->user_id),
            ];

            return $conteudo->comentarios;

        }else
            return ['status' => false, "erro" => 'Conteudo não existe'];


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function pagina(Request $request, $id)
    {
        $donoDaPagina = User::find($id);

        if($donoDaPagina){
            $conteudos = $donoDaPagina->conteudos()
                ->with('user')
                ->orderBy('data', 'desc')
                ->paginate(5);
            $user = $request->user();
            foreach ($conteudos as $key => $conteudo) {
                $conteudo->total_curtidas = $conteudo->curtidas()->count();
                $conteudo->comentarios = $conteudo->comentarios()->with('user')->orderBy('data', 'desc')->get();
                $curtiu = $user->curtidas()->find($conteudo->id);

                if ($curtiu)
                    $conteudo->curtiu_conteudo = true;
                else
                    $conteudo->curtiu_conteudo = false;
            }

            return [
                'status' => true,
                "conteudos" => $conteudos,
                'dono' => $donoDaPagina
            ];
        } else
            return ['status' => false, 'erro' => 'Usuário não encontrado'];
    }
}
