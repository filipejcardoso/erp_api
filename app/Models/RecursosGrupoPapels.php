<?php

namespace App\Models;
//-------------------------------------------------
use Illuminate\Database\Eloquent\Model;
//-------------------------------------------------
class RecursosGrupoPapels extends Model
{
	protected $table = 'recursos_grupo_papels';
	protected $primaryKey = 'id';
	protected $fillable = ['papels_id', 'recursos_grupo_id', 'crud'];

	static public function relacoes()
	{
		return ['recursos_grupo'];
	}

	static public function relacoesModel()
	{
		return ['App\Models\RecursosGrupos'];
	}

	static public function recursos_grupo()
	{
		return $this->belongsTo('App\Models\RecursosGrupos', 'recursos_grupo_id');
	}
}