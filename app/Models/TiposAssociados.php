<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposAssociados extends Model
{
    protected $table = 'tipos_associados';
    protected $primaryKey = 'id';
    protected $fillable = ['codigo', 'nome'];

    static public function relacoes()
    {
    	return [];
    }

    static public function relacoesModel()
    {
    	return [];
    }
}
