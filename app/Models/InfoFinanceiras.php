<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoFinanceiras extends Model
{
	protected $table = 'info_financeiras';
    protected $primaryKey = 'id';
    protected $fillable = ['consumidor','limite'];

    static public function relacoes()
    {
        return []; 
    }

    static public function relacoesModel()
    {
        return []; 
    }

}
