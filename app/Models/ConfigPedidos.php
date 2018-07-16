<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigPedidos extends Model
{
	protected $table = 'config_pedidos';
    protected $primaryKey = 'id';
    protected $fillable = ['validade','associado_id'];

    static public function relacoes()
    {
        return ['associado']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Associados'];
    }

    public function associado()
    {
        return $this->belongsTo('App\Models\Associados','associado_id');
    }  
}
