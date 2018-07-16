<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposEnderecos extends Model
{
	protected $table = 'tipos_enderecos';
    protected $primaryKey = 'id';
    protected $fillable = ['nome'];

    static public function relacoes()
    {
        return []; 
    }

    static public function relacoesModel()
    {
        return [];
    }
}
