<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
	protected $table = 'marcas';
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
