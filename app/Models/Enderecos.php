<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enderecos extends Model
{
    protected $table = 'enderecos';
    protected $primaryKey = 'id';
    protected $fillable = ['logradouro', 'numero', 'bairro', 'complemento', 'regioes_id', 'tipos_endereco_id', 'cep'];

    static public function relacoes()
    {
        return ['tipos_endereco','regioes']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\TiposEnderecos','App\Models\Regioes'];
    }

    public function tipos_endereco()
    {
        return $this->belongsTo('App\Models\TiposEnderecos','tipos_endereco_id');
    }

    public function regioes()
    {
        return $this->belongsTo('App\Models\Regioes','regioes_id');
    }
}
