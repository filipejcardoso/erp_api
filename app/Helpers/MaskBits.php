<?php
namespace App\Helpers;
use DB;
//------------------------------
class MaskBits
{

	static function getTags($value)
	{
		$tags = [];

		for($i=1;$i<=64;$i++)
		{
			$and = $value & $i;
			if($and)
				array_push($tags, $i);
		}

		return $tags;
	}

	static function setBuilderAssociadosTags($builder, $tag)
	{
		$tags = self::getTags($tag);

		$query = '';
		foreach($tags as $key=>$value)
		{
			if($key == 0)
				$query = $query."(tipo_associado='" . $value . "'";
			else
				$query = $query." OR tipo_associado='" . $value . "'";
		}
		$query = $query.")";

		$builder->whereRaw($query);
	}
}