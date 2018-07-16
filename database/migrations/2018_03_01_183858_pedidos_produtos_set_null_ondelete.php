<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PedidosProdutosSetNullOndelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos_produtos', function (Blueprint $table) {
            $table->dropForeign('pedidos_produtos_produto_id_foreign');

            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos_produtos', function (Blueprint $table) {
            $table->dropForeign('pedidos_produtos_produto_id_foreign');

            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }
}
