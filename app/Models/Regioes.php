<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regioes extends Model
{
	protected $table = 'regioes';
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
