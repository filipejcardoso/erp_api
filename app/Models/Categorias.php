<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
	protected $table = 'categorias';
    protected $primaryKey = 'id';
    protected $fillable = ['nome'];

    static public function relacoes()
    {
        return ['subcategoria']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Subcategorias'];
    }

    public function subcategoria()
    {
        return $this->hasMany('App\Models\Subcategorias', 'categoria_id');
    }
}
