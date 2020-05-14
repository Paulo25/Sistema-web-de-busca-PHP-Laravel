<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criador extends Model
{
    protected $table = "criador";
    protected $primaryKey = "idcriador";

    
    public $timestamps = false;
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome_criador', 'nascimento','sobre','fk_lingua_progs'
    ];


    public function lingua(){
        return $this->hasMany('App\Lingua_progs');
    }
}
