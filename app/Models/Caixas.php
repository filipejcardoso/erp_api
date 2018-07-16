<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caixas extends Model
{
	protected $table = 'caixas';
    protected $primaryKey = 'id';
    protected $fillable = ['status','user_id','dinheiro','debito','credito','cheque','carteira','outros'];
    
    static public function relacoes()
    {
        return ['movimentacao','venda','user']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Movimentacaos', 'App\Models\Vendas','App\Models\User'];
    }

    public function movimentacao()
    {
        return $this->hasMany('App\Models\Movimentacaos','caixa_id');
    }
    
    public function venda()
    {
        return $this->hasMany('App\Models\Vendas','caixa_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User','user_id');
    }
}
