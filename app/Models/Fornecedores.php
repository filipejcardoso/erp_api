<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedores extends Model
{
	protected $table = 'fornecedores';
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

