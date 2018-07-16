<?php
namespace App\Helpers;
//------------------------------
use App\Models\User;
use App\Models\Papels;
use App\Models\RecursosGrupos;
//------------------------------
class Papel
{
	public function isPermission($usuario, $resource, $crud)
	{		
		foreach($usuario->papel->recursos_grupo as $recurso_grupo)
		{
			$recursoGrupo = RecursosGrupos::findOrFail($recurso_grupo->id);

			foreach($recursoGrupo->recurso as $recurso)
			{
				if($resource == $recurso->recurso)
				{
					return($recurso_grupo->crud&$crud);
				}
			}
		}
	}
}