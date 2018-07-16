<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationshipProdutosFornecedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos_fornecedores', function (Blueprint $table) {
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos_fornecedores', function (Blueprint $table) {
            $table->dropForeign('produtos_produto_id_foreign');
            $table->dropForeign('produtos_fornecedor_id_foreign');
        });
    }
}
