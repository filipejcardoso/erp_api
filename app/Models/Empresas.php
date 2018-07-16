<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
	protected $table = 'empresas';
    protected $primaryKey = 'id';
    protected $fillable = ['nome','razao_social','cpf_cnpj','ie','im','telefone','email','site'];

    static public function relacoes()
    {
        return ['endereco']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Enderecos'];
    }

    public function endereco()
    {
        return $this->belongsTo('App\Models\Enderecos','endereco_id');
    }  
}
