<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
	protected $table = 'vendas';
    protected $primaryKey = 'id';
    protected $fillable = ['status','caixa_id','user_id','associado_id','observacao','desconto','valor','valor_carteira'];
    
    static public function relacoes()
    {
        return ['pagamento','user','associado']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Pagamentos', 'App\Models\User','App\Models\Associados'];
    }

    public function pagamento()
    {
        return $this->hasMany('App\Models\Pagamentos','venda_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function associado()
    {
    	return $this->belongsTo('App\Models\Associados','associado_id');
    }
}
