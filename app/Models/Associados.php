<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Associados extends Model
{
	protected $table = 'associados';
    protected $primaryKey = 'id';
    protected $fillable = ['tipo','situacao','nome','email','cpf_cnpj','rg','razao_social','ie','im','telefone_comercial','telefone_celular','fax','nascimento','tipo_contribuinte','site','grupos_associado_id', 'indicacao_id', 'tipo_associado'];

    
    static public function relacoes()
    {
        return ['referencias_bancaria','contato','endereco','info_financeira','grupos_associado']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\ReferenciasBancarias', 'App\Models\Contatos', 'App\Models\Enderecos', 'App\Models\InfoFinanceiras', 'App\Models\GruposAssociados'];
    }

    public function contato()
    {
        return $this->hasMany('App\Models\Contatos','associado_id');
    }

    public function info_financeira()
    {
        return $this->hasOne('App\Models\InfoFinanceiras','associado_id');
    }

    public function referencias_bancaria()
    {
        return $this->hasMany('App\Models\ReferenciasBancarias','associado_id');
    }

    public function endereco()
    {
        return $this->hasMany('App\Models\Enderecos','associado_id');
    }  

    public function grupos_associado()
    {
        return $this->belongsTo('App\Models\GruposAssociados','grupos_associado_id');
    }
}
