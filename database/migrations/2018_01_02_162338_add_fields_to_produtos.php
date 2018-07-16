<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->string('codbarras')->nullable(false)->after('nome');
            $table->float('preco_compra',8,2)->nullable(false)->after('codbarras');
            $table->integer('unidades_medida_id')->unsigned()->nullable(false)->after('marca_id');
            $table->integer('estoque_id')->unsigned()->nullable(false)->after('unidades_medida_id');
            $table->integer('dados_fiscal_id')->unsigned()->nullable(false)->after('estoque_id');
            $table->integer('dimensao_id')->unsigned()->nullable(false)->after('dados_fiscal_id');
            $table->integer('subcategoria_id')->unsigned()->nullable(false)->after('dimensao_id');
            $table->integer('loja_id')->unsigned()->nullable(false)->after('subcategoria_id');
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
            $table->dropColumn('codbarras');
            $table->dropColumn('preco_compra');
            $table->dropColumn('unidades_medida_id');
            $table->dropColumn('estoque_id');
            $table->dropColumn('dados_fiscal_id');
            $table->dropColumn('dimensao_id');
            $table->dropColumn('subcategoria_id');
            $table->dropColumn('loja_id');
        });
    }
}
