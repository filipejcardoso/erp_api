<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->foreign('unidades_medida_id')->references('id')->on('unidades_medidas');
            $table->foreign('estoque_id')->references('id')->on('estoques');
            $table->foreign('dados_fiscal_id')->references('id')->on('dados_fiscals');
            $table->foreign('dimensao_id')->references('id')->on('dimensaos');
            $table->foreign('subcategoria_id')->references('id')->on('subcategorias');
            $table->foreign('loja_id')->references('id')->on('lojas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign('produtos_unidades_medida_id_foreign');
            $table->dropForeign('produtos_estoque_id_foreign');
            $table->dropForeign('produtos_dados_fiscal_id_foreign');
            $table->dropForeign('produtos_dimensao_id_foreign');
            $table->dropForeign('produtos_subcategoria_id_foreign');
            $table->dropForeign('produtos_loja_id_foreign');
        });
    }
}
