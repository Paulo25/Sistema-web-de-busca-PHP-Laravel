<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    protected $table = "imagem";
    protected $primaryKey = "id_imagem";

    
    public $timestamps = false;
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path_imagem', 'fk_img_lingua'
    ];

}
