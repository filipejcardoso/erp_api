<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposContatos extends Model
{
	protected $table = 'tipos_contatos';
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
