<?php

namespace App\Exceptions;

use Exception;

class EmptyException extends Exception
{
	protected $message = "Not found";
}