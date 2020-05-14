<?php

namespace App\Http\Controllers;

use App\Lingua_progs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $now =  Carbon::now();
        $graficDataCreatedLanguage = $this->getDataCreatedLanguage($now);
        return view('system.dashboard', compact('graficDataCreatedLanguage'));
    }

    /**
     * Método reponsavel por carregar dados do grafico de linguagem criadas no ano
     * @param $now
     * @return false
     */
    public function getDataCreatedLanguage($now)
    {
        $languages = Lingua_progs::whereYear('dt_criacao', $now->year)->get()->groupBy(function ($value){
           return Carbon::parse($value->dt_criacao)->format('m');
        });

        $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,];

        foreach ($languages as $key => $language){
            $i = intval($key) -1;
            $data[$i] = $language->count();
        }
        return json_encode($data);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
