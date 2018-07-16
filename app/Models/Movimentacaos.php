<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacaos extends Model
{
	protected $table = 'movimentacaos';
    protected $primaryKey = 'id';
    protected $fillable = ['tipo','valor','titulo','observacao','caixa_id'];
    
    static public function relacoes()
    {
        return []; 
    }

    static public function relacoesModel()
    {
        return [];
    }
}