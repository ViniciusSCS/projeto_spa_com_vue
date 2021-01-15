<?php

namespace App\Http\Controllers;

use App\Models\Conteudo;
use App\Models\User;
use Illuminate\Http\Request;

class ConteudoController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listar()
    {
        $conteudos =  Conteudo::with('user')
            ->orderBy('data', 'desc')
            ->paginate(5);

        return ['status'=>true,"conteudos" => $conteudos];
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

        $conteudo = new Conteudo();

        $conteudo->link = $data['link'];
        $conteudo->texto = $data['texto'];
        $conteudo->imagem = $data['imagem'];
        $conteudo->data = date('Y-m-d H:i:s');
        $conteudo->user_id = $data['usuario']['id'];

        $conteudo->save();

        $conteudos =  Conteudo::with('user')
            ->orderBy('data', 'desc')
            ->paginate(5);

        return ['status'=>true,"conteudos" => $conteudos];

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
