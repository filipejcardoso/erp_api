<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GruposAssociados extends Model
{
	protected $table = 'grupos_associados';
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
