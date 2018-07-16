<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GestaoEstoques extends Model
{
	protected $table = 'gestao_estoques';
    protected $primaryKey = 'id';
    protected $fillable = ['curva_abc'];
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
