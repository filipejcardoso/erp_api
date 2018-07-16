<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidosProdutos extends Model
{
    protected $table = 'pedidos_produtos';
    protected $primaryKey = 'id';
    protected $fillable = ['quantidade', 'desconto'];

    static public function relacoes()
    {
    	return [];
    }

    static public function relacoesModel()
    {
    	return [];
    }
}
