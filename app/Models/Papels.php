<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Papels extends Model
{
	protected $table = 'papels';
    protected $primaryKey = 'id';
    protected $fillable = ['nome', 'desconto'];

    static public function relacoes()
    {
    	return ['recursos_grupo_papels'];
    }

	static public function relacoesModel()
    {
    	return ['App\Models\RecursosGrupoPapels'];
    }

    public function recursos_grupo_papels()
    {
        return $this->hasMany('App\Models\RecursosGrupoPapels', 'papels_id');
    }
}