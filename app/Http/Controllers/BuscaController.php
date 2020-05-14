<?php

namespace App\Http\Controllers;

use App\Enums\LinguagemStatus;
use App\Lingua_progs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BuscaController extends Controller
{

    public function index()
    {
        $infos = new Lingua_progs();
        $infoAssociado = new Lingua_progs();
        return view('site.index', compact('infos', 'infoAssociado'));
    }

    public function buscar(Request $request)
    {
        $infos = 0;
        $infoAssociado = 0;
        $palavra = $request->get('nome');
       
        $validator = $this->validatorRequest('GET', $request->all());
        if ($validator->fails()) {
            return view('site.index', compact('infos', 'infoAssociado'))->withErrors($validator);
        }

        if(!empty($palavra)){   
            $infos = Lingua_progs::where([['nome', '=', mb_strtoupper($palavra,"utf-8")], ['status', '=', LinguagemStatus::ATIVO]])
            ->leftjoin('imagem', 'imagem.fk_img_lingua','lingua_progs.id')->first();             
            if($infos == null){
                $infoAssociado = Lingua_progs::where([['nome', 'like', '%'.$palavra.'%'],['status', '=', LinguagemStatus::ATIVO]])->first();
                }
        }

        session()->flashInput($request->input());
        return view('site.index', compact('infos', 'infoAssociado'));
    }

    public function buscarPalavraAssociada(Request $request, $nome)
    {
        $infoAssociado = null;
        $infos = Lingua_progs::where('nome', 'like', '%'.$nome.'%')
        ->leftjoin('imagem', 'imagem.fk_img_lingua', 'lingua_progs.id')->first();   

        return view('site.index', compact('infos', 'infoAssociado'));
    }







    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Busca  $busca
     * @return \Illuminate\Http\Response
     */
    public function show(Busca $busca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Busca  $busca
     * @return \Illuminate\Http\Response
     */
    public function edit(Busca $busca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Busca  $busca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Busca $busca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Busca  $busca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Busca $busca)
    {
        //
    }


    /**
     * Efetua validação dos campos retornados da request
     *
     * @param string $verb
     * @param array $data
     * @param int|null $id
     * @return mixed
     */
    private function validatorRequest(string $verb, array $data, int $id = null)
    {
        $validatorRules = [];

        if ($verb === 'GET') {
            $validatorRules = [
                'nome' => 'required'
            ];
        } 
        $messages = [
            'required' => 'O campo acima é obrigatório!',
        ];
        return Validator::make($data, $validatorRules, $messages);
    }
}
