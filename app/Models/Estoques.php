<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoques extends Model
{
	protected $table = 'estoques';
    protected $primaryKey = 'id';
    protected $fillable = ['quantidade', 'area', 'rua', 'modulo', 'nivel', 'vao'];
    public $onePerOne = true;

    static public function relacoes()
    {
        return []; 
    }

    static public function relacoesModel()
    {
        return [];
    }

}
