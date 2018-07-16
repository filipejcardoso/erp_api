<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicos extends Model
{
    protected $table = 'servicos';
    protected $primaryKey = 'id';
    protected $fillable = ['nome', 'cod', 'valor_unit', 'observacao'];

    public static function relacoes()
    {
    	return [];
    }

    public static function relacoesModel()
    {
    	return [];
    }
}
