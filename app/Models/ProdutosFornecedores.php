<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutosFornecedores extends Model
{
	protected $table = 'produtos_fornecedores';
    protected $primaryKey = 'id';

    static public function relacoes()
    {
        return []; 
    }

    static public function relacoesModel()
    {
        return [];
    }
}
