<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaixasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caixas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status');
            $table->unsignedInteger('user_id');
            $table->float('dinheiro', 8,2)->nullable();
            $table->float('debito', 8,2)->nullable();
            $table->float('credito', 8,2)->nullable();
            $table->float('cheque', 8,2)->nullable();
            $table->float('carteira', 8,2)->nullable();
            $table->float('outros', 8,2)->nullable();
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
        Schema::dropIfExists('caixas');
    }
}
