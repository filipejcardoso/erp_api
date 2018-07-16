<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lojas extends Model
{
	protected $table = 'lojas';
    protected $primaryKey = 'id';
    protected $fillable = ['nome'];

    static public function relacoes()
    {
        return []; 
    }

    static public function relacoesModel()
    {
        return [];
    }

}
