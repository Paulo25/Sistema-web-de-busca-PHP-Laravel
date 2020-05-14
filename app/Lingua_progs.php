<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lingua_progs extends Model
{

    protected $table = "lingua_progs";
    protected $primaryKey = "id";


     /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'dt_criacao';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'dt_atualizacao';

    
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'conteudo','status','topo'
    ];

    public function criador(){
        return $this->belongsTo('App\Criador', 'fk_lingua_progs', 'id');
    }

    //relacionamento um-a-um, Uma linguagem está associado a Uma imagem
    public function imagem(){
       return  $this->hasOne('App\Imagem', 'fk_img_lingua', 'id');
    }
}
