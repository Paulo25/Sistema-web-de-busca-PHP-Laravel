<?php

namespace App\Http\Controllers;

use App\Enums\UsuarioStatus;
use App\Usuario;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Usuario::all();
        return view('system.usuario.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = Usuario::find($id);
            return view('system.usuario.edit', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $httpCode = 500;
            $refresh = false;
            $dataAlert = [
                'title' => 'Erro',
                'text' => 'Não foi possivel executar está ação!',
                'icon' => 'error'
            ];

            $validator = $this->validatorRequest('PUT', $request->all());

            if ($validator->fails()) {
                return response()->json(compact('refresh'), 403);
            }

            try {
                DB::beginTransaction();
                $user = Usuario::find($id);
                if ($user) {
                    $user->nome = $request->nome;
                    $user->email = $request->email;
                    $user->senha = encrypt($request->senha);

                    $user->update();
                    $httpCode = 200;
                    $refresh = true;
                    $dataAlert = [
                        'title' => 'Sucesso',
                        'text' => 'Usuário atualizado com sucesso!',
                        'icon' => 'success'
                    ];
                    DB::commit();
                    return response()->json(compact('dataAlert', 'refresh'), $httpCode);
                }
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(compact('dataAlert', 'refresh'), $httpCode);
            }

        }

    }

    public function alterStatusUser(Request $request, $idUser)
    {
        if ($request->ajax()) {
            $httpCode = 500;
            $refresh = true;
            $dataAlert = [
                'title' => 'Falha na operação!',
                'text' => 'Não foi possivel efetuar a alteração do status do usuário. Tente novamente!',
                'icon' => 'Error'
            ];
            $user = Usuario::find($idUser);
            $statusValue = [UsuarioStatus::ATIVO, UsuarioStatus::INATIVO];
            if ($user && is_numeric($request->status) && in_array($request->status, $statusValue)) {
                $user->status = $request->status;
                if ($user->update()) {
                    $httpCode = 200;

                    if ($user->status == UsuarioStatus::ATIVO) {
                        $dataAlert = [
                            'title' => 'Sucesso',
                            'text' => "Usuário '{$user->nome}' foi ativado.",
                            'icon' => 'success'
                        ];
                    } else {
                        $dataAlert = [
                            'title' => 'Sucesso',
                            'text' => "Usuário '{$user->nome}' foi desativado.",
                            'icon' => 'success'
                        ];
                    }
                }
            }
        }
        return response()->json(compact('dataAlert', 'refresh'), $httpCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    private function validatorRequest(string $verb, array $data, int $id = null)
    {
        $validatorRules = [];

        if ($verb === 'PUT') {
            $validatorRules = [
                'nome' => 'required',
                'email' => 'required|max:100|email',
                'senha' => 'required|max:15'
            ];
        }

        $menssages = [
            'required' => 'Este campo é obrigatório!',
            'unique' => 'Já existe um registro com essa informação',
            'max' => 'Quantidade de caracteres superior a permitida',
            'email' => 'E-mail inválido'
        ];

        return Validator::make($data, $validatorRules, $menssages);
    }
}
