<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
	protected $table = 'pedidos';
    protected $primaryKey = 'id';

    static public function relacoes()
    {
    	return ['pedidos_produto','atendente','cliente'];
    }

	static public function relacoesModel()
    {
    	return ['App\Models\PedidosProdutos','App\Models\User','App\Models\Associados'];
    }

    public function pedidos_produto()
    {
        return $this->hasMany('App\Models\PedidosProdutos', 'pedido_id');
    }

    public function atendente()
    {
        return $this->belongsTo('App\Models\User', 'atendente');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Models\Associados', 'cliente');
    }
}
