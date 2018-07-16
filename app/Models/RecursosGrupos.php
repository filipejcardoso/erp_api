<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecursosGrupos extends Model
{
	protected $table = 'recursos_grupos';
    protected $primaryKey = 'id';
    protected $fillable = ['nome', 'crud'];

    static public function relacoes()
    {
    	return ['recurso'];
    }

	static public function relacoesModel()
    {
    	return ['App\Models\Recursos'];
    }

    public function recurso()
    {
        return $this->hasMany('App\Models\Recursos', 'recursos_grupo_id');
    }
}
