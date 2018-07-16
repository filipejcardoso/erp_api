<?php
namespace App\Helpers;
//------------------------------
class Helper
{

	static function lastURI($value)
	{
		$value_explode = explode('/', $value);

		$size = count($value_explode);

		return $value_explode[$size - 1];
	}

	static function firstVerb($value)
	{
		return $value[0];
	}

	static function codeVerb($value)
	{
		$code = null;
		switch($value)
		{
			case 'DELETE':
				$code = 1;
			break;
			case 'PATCH':
				$code = 2;
			break;
			case 'GET':
				$code = 4;
			break;
			case 'POST': 
				$code = 8;
			break;
		}

		return $code;
	}
}