<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadesMedidas extends Model
{
	protected $table = 'unidades_medidas';
    protected $primaryKey = 'id';
    protected $fillable = ['descricao'];

    static public function relacoes()
    {
        return []; 
    }

    static public function relacoesModel()
    {
        return [];
    }
}
