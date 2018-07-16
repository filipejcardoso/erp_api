<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategorias extends Model
{
	protected $table = 'subcategorias';
    protected $primaryKey = 'id';
    protected $fillable = ['nome'];

    static public function relacoes()
    {
        return ['categoria']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Categorias'];
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categorias','categoria_id');
    }
}
