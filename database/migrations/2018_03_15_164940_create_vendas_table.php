<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status');
            $table->unsignedInteger('caixa_id'); //caixa da venda
            $table->unsignedInteger('user_id'); //quem realizou o pedido
            $table->unsignedInteger('associado_id'); //cliente da venda
            $table->mediumText('observacao');
            $table->float('desconto', 8,2)->nullable();
            $table->float('valor', 8,2)->nullable();
            $table->float('valor_carteira', 8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
