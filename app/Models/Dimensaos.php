<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dimensaos extends Model
{
	protected $table = 'dimensaos';
    protected $primaryKey = 'id';
    protected $fillable = ['peso', 'altura', 'largura', 'comprimento', 'diametro'];
    public $onePerOne = true;

    static public function relacoes()
    {
        return []; 
    }

    static public function relacoesModel()
    {
        return [];
    }

 }
