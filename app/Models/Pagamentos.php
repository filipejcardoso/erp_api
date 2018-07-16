<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamentos extends Model
{
	protected $table = 'pagamentos';
    protected $primaryKey = 'id';
    protected $fillable = ['tipo','valor','venda_id'];
    
    static public function relacoes()
    {
        return []; 
    }

    static public function relacoesModel()
    {
        return [];
    }}
