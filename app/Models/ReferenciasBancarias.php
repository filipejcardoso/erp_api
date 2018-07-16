<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenciasBancarias extends Model
{
	protected $table = 'referencias_bancarias';
    protected $primaryKey = 'id';
    protected $fillable = ['banco','agencia','conta','nome','cpf_cnpj','descricao'];

    static public function relacoes()
    {
        return []; 
    }

    static public function relacoesModel()
    {
        return []; 
    }

}
