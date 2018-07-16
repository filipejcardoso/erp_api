<?php
namespace App\Helpers;
//------------------------------
class Roles
{
	private $recursosGroup = [
		'produtosGroup' => ['produtos'],
		'clientesGroup' => ['clientes']
	];

	private $roles = [
		'Administrador' => 0,
		'Restrito' => 1
	];

	private $permissoes = [
		'0' => [
			'produtosGroup' => 15,
			'clientesGroup' => 15
		],
		'1' => [
			'produtosGroup' => 7,
			'clientesGroup' => 14
		]
	];

	public function isPermission($user, $recurso, $crud)
	{
		$rgrupo = 0;
		$papel = $user->role_id;

		foreach($this->recursosGroup as $key=>$rvalue)
		{
			if(in_array($recurso, $rvalue))
			{
				$rgrupo = $key;
			}
		}

		if($rgrupo)
		{
			$roleP = $this->permissoes[$papel][$rgrupo];
			return ($roleP&$crud);
		}
		else
			return true;
	}
}