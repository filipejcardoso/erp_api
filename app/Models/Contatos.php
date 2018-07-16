<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contatos extends Model
{
    protected $table = 'contatos';
    protected $primaryKey = 'id';
    protected $fillable = ['nome', 'contato', 'cargo', 'observacao', 'tipos_contato_id'];

    static public function relacoes()
    {
        return ['tipos_contato']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\TiposContatos'];
    }

    public function tipos_contato()
    {
        return $this->belongsTo('App\Models\TiposContatos','tipos_contato_id');
    }
}
