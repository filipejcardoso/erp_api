<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracoes extends Model
{
	protected $table = 'configuracoes';
    protected $primaryKey = 'id';
    protected $fillable = [];

    static public function relacoes()
    {
        return ['config_pedido']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\ConfigPedidos'];
    }

    public function config_pedido()
    {
        return $this->belongsTo('App\Models\ConfigPedidos','config_pedido_id');
    }  
}
