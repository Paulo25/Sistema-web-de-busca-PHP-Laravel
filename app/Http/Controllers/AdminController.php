<?php

namespace App\Http\Controllers;

use App\Exports\Exportacao;
use Illuminate\Http\Request;
use App\Lingua_progs;
use App\Imagem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use DB;


class AdminController extends Controller
{

    public function home()
    {
        return view('system.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $questions = Lingua_progs::OrderBy('topo', 'desc')
            ->leftjoin('imagem', 'imagem.fk_img_lingua', 'lingua_progs.id')
            ->paginate(6);

        // $questions = DB::table('criador')
        // ->join('lingua_progs', 'lingua_progs.id', 'criador.fk_lingua_progs')
        // ->OrderBy('lingua_progs.id', 'asc')
        // ->paginate(6);

        return view('system.index', compact('questions'));
    }

    public function search(Request $request)
    {
        $filter = $request->except('_thoken', '_method');
        $conditions = [];

        if ($filter != null && isset($filter["data"])) {
            //$date = date('Y-m-d', strtotime($filter["data"]));
            $conditions[] = ['dt_atualizacao', '=', $filter["data"]];
        }
        if ($filter != null && isset($filter["nome"])) {
            $conditions[] = ['nome', 'like', "%{$filter['nome']}%"];
        }
        $questions = Lingua_progs::leftjoin('imagem', 'imagem.fk_img_lingua', 'lingua_progs.id')
            ->where($conditions)
            ->OrderBy('topo', 'desc')
            ->OrderBy('id', 'asc')
            ->paginate(6);
        session()->flashInput($request->input());

        return view('system.index', compact('questions', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('system.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:50',
            'conteudo' => 'required',
        ], [
            'nome.required' => 'Nome é de preenchimento obrigatório!',
            'conteudo.required' => 'Conteúdo é de preenchimento obrigatório!',
            'max' => 'Este campo suporta no máximo 50 caracteres.'
        ]);

        if ($validator->fails()) {
            return redirect('system/create')->withErrors($validator)->withInput();
        }

        $linguagem = new Lingua_progs;
        $linguagem->nome = $request->get('nome');
        $linguagem->conteudo = $request->get('conteudo');
        $linguagem->topo = $request->get('checkbox');
        $linguagem->save();

        if ($request->file('arquivo')) {
            $path = $request->file('arquivo')->storePubliclyAs('imagens', $request->file('arquivo')->getClientOriginalName(), 'public');
            if (isset($path)) {
                $image = new Imagem;
                $image->path_imagem = $path;
                $image->fk_img_lingua = $linguagem->id;
                $image->save();
            }
        }
        return redirect('system/create')->with('sucess', 'linguagem de progamação salva com sucesso!');
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
            $question = Lingua_progs::where('id', '=', $id)
                ->leftjoin('imagem', 'fk_img_lingua', '=', 'lingua_progs.id')->first();
            if ($question) {
                return view('system.edit', compact('question'));
            }
        }
        //return response()->json(abort(404));
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
        $success = false;
        $view = null;

        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:50',
            'conteudo' => 'required',
            'status' => 'required'
        ], [
            'nome.required' => 'Nome é de preenchimento obrigatório!',
            'conteudo.required' => 'Conteúdo é de preenchimento obrigatório!',
            'status.required' => 'Status é de preenchimento obrigatório!',
            'max' => 'Este campo suporta no máximo 50 caracteres.'
        ]);

        if ($validator->fails()) {
            //session()->flashInput($request->input());
            //$view = view('system.edit')->withErrors($validator)->render();
            return response()->json(compact('success'), 403);
        }
        try {
            DB::beginTransaction();
            $linguagem = Lingua_progs::find($id);
            $imagem = Imagem::where('fk_img_lingua', $id)->first();
            if ($linguagem) {
                $linguagem->nome = $request->get('nome');
                $linguagem->conteudo = $request->get('conteudo');
                $linguagem->status = $request->get('status');
                $linguagem->topo = $request->get('checkbox');
                $linguagem->update();
                $success = true;


                if ($request->file('arquivo')) {
                    if ($imagem) {
                        $imagem->path_imagem = $request->file('arquivo')->storePubliclyAs('imagens', $request->file('arquivo')->getClientOriginalName(), 'public');
                        $imagem->update();
                    } else {
                        $imagem = new Imagem;
                        $imagem->fk_img_lingua = $id;
                        $imagem->path_imagem = $request->file('arquivo')->storePubliclyAs('imagens', $request->file('arquivo')->getClientOriginalName(), 'public');
                        $imagem->save();
                    }
                    $success = true;
                }
                DB::commit();
                return response()->json(compact('success'));
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(compact('success'));
        }
    }


    public function delete(Request $request, $id)
    {
        if ($request->ajax()) {
            $linguagem = Lingua_progs::find($id);
            return view('system.delete', compact('linguagem'));
        }
        return response()->json(abort(404));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        if ($request->ajax()) {
            $success = false;
            $linguagem = Lingua_progs::find($id);
            if ($linguagem) {
                $imagem = Imagem::where('fk_img_lingua', '=', $id);
                $arquivo = $request->arquivo;
                Storage::disk('public')->delete($arquivo);
                if ($imagem) $imagem->delete();
                if ($linguagem->delete()) {
                    $success = true;
                    $alert = [
                        'title' => 'Sucesso!',
                        'text' => 'Operação efetuada com sucesso.',
                        'icon' => 'success'
                    ];
                }
            }
            return response()->json(compact('success', 'alert'));
        }
    }


    public function imagem()
    {
        $imagens = Imagem::All();
        return view('system.imagem', compact('imagens'));
    }

    public function imagemDelete(Request $request, $id)
    {
        if ($request->ajax()) {
            $imagem = Imagem::find($id);
            return view('system.delete-imagem', compact('imagem'));
        }
    }

    public function imagemDestroy(Request $request, $id)
    {
        if ($request->ajax) {
            $httpCode = 500;
            $success = false;
            $imagem = Imagem::find($id);
            if ($imagem->delete()) {
                $httpCode = 200;
                $success = true;
                $alert = [
                    'title' => 'Sucesso!',
                    'text' => 'Solicitação realizada com sucesso.',
                    'icon' => 'success'
                ];
            }
            return response()->json(compact('success', 'alert'), $httpCode);
        }
    }

    public function imagemDownload($id)
    {
        $imagem = Imagem::find($id);
        if ($imagem) {
            $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $imagem->path_imagem);
            return response()->download($path);
        }
    }


    public function export(Request $request)
    {
        $condition = [];

        if ($request->has('nome') && $request->nome) {
            $condition[] = ['nome', 'like', '%' . $request->nome . '%'];
        }
        if ($request->has('data') && $request->data) {
            $condition[] = ['dt_atualizacao', '=', $request->data];
        }

        $isPath = (new Exportacao($condition))->store('export.xlsx');

        if ($isPath) {
            $file = storage_path('app\export.xlsx');
            $fileContents = file_get_contents($file);
            $response = [
                'name' => 'linguagens.xlsx',
                'file' => 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,' . base64_encode($fileContents)
            ];
        }

        return response()->json($response);
    }

}




