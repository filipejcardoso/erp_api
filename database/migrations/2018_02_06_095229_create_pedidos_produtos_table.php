<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pedido_id');
            $table->unsignedInteger('produto_id')->nullable();
            $table->string('codbarras');
            $table->string('nome');
            $table->string('marca');
            $table->string('unidade_medida');
            $table->unsignedInteger('quantidade');
            $table->float('preco_compra', 8,2)->nullable();
            $table->float('preco_venda', 8,2);
            $table->float('desconto', 8,2)->nullable();
            $table->float('preco', 8,2)->nullable();
            $table->string('ncm');
            $table->string('cfop');
            $table->timestamps();

            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('pedidos_produtos_pedido_id_foreign');
        $table->dropForeign('pedidos_produtos_produto_id_foreign');
        Schema::dropIfExists('pedidos_produtos');
    }
}
