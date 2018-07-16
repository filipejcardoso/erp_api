<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
	protected $table = 'produtos';
    protected $primaryKey = 'id';
    protected $fillable = ['nome','codbarras','preco_compra','preco_venda','marca_id', 'unidades_medida_id', 'estoque_id', 'dados_fiscal_id', 'dimensao_id', 'subcategoria_id', 'loja_id'];

    static public function relacoes()
    {
        return ['marca','unidades_medida','estoque','dados_fiscal','dimensao','subcategoria', 'loja']; 
    }

    static public function relacoesModel()
    {
        return ['App\Models\Marcas', 'App\Models\UnidadesMedidas', 'App\Models\Estoques', 'App\Models\DadosFiscals', 'App\Models\Dimensaos', 'App\Models\Subcategorias', 'App\Models\Lojas'];
    }

    public function marca()
    {
        return $this->belongsTo('App\Models\Marcas','marca_id');
    }

    public function unidades_medida()
    {
        return $this->belongsTo('App\Models\UnidadesMedidas','unidades_medida_id');
    }

    public function estoque()
    {
        return $this->belongsTo('App\Models\Estoques','estoque_id');
    }

    public function dados_fiscal()
    {
        return $this->belongsTo('App\Models\DadosFiscals','dados_fiscal_id');
    }

    public function dimensao()
    {
        return $this->belongsTo('App\Models\Dimensaos','dimensao_id');
    }

    public function subcategoria()
    {
        return $this->belongsTo('App\Models\Subcategorias','subcategoria_id');
    }

    public function loja()
    {
        return $this->belongsTo('App\Models\Lojas','loja_id');
    }

    protected static function boot() 
    {
        self::deleted(function($produto){
            $produto->estoque()->delete();
            $produto->dados_fiscal()->delete();
            $produto->dimensao()->delete();
        });
    }

}
