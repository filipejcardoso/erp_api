<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegioesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regioes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('codigo_uf');
            $table->string('uf');
            $table->string('uf_nome');
            $table->unsignedInteger('codigo_municipio');
            $table->string('municipio');
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
        Schema::dropIfExists('regioes');
    }
}
