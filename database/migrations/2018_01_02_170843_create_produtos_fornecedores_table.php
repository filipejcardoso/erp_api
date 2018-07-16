<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosFornecedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_fornecedores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fornecedor_id')->unsigned()->nullable(false);
            $table->integer('produto_id')->unsigned()->nullable(false);
            $table->string('codigo');
            $table->integer('tempo_entrega')->unsigned()->nullable(false);
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
        Schema::dropIfExists('produtos_fornecedores');
    }
}
