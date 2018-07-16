<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DadosFiscals extends Model
{
	protected $table = 'dados_fiscals';
    protected $primaryKey = 'id';
    protected $fillable = ['ncm', 'cfop'];
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
