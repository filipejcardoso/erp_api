<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('status');
            $table->unsignedInteger('atendente');
            $table->unsignedInteger('cliente')->nullable();
            $table->longText('observacao')->nullable();
            $table->float('desconto', 8,2)->nullable();
            $table->float('valor', 8,2)->nullable();
            $table->timestamps();

            $table->foreign('atendente')->references('id')->on('users');
            $table->foreign('cliente')->references('id')->on('associados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('pedidos_atendente_foreign');
        $table->dropForeign('pedidos_cliente_foreign');
        Schema::dropIfExists('pedidos');
    }
}
