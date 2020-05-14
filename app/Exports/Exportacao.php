<?php

namespace App\Exports;



use App\Lingua_progs;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class Exportacao implements FromView
{
    use Exportable;
    private $condition = [];

    public function __construct(array $condition){
        $this->condition = $condition;
    }

    public function view(): View
    {
        $linguagens = Lingua_progs::where($this->condition)->orderBy('nome')->get();

        return view('system.export', compact('linguagens'));
    }
}
