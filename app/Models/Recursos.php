<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recursos extends Model
{
	protected $table = 'recursos';
    protected $primaryKey = 'id';
    protected $fillable = ['recurso', 'recursos_grupo_id'];

    static public function relacoes()
    {
    	return [];
    }

	static public function relacoesModel()
    {
    	return [];
    }
}
