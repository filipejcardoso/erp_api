<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PedidosProdutosUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos_produtos', function (Blueprint $table) {
            $table->dropForeign('pedidos_produtos_pedido_id_foreign');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
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
            $table->dropForeign('pedidos_produtos_pedido_id_foreign');
            $table->foreign('pedido_id')->references('id')->on('pedidos');
        });
    }
}
