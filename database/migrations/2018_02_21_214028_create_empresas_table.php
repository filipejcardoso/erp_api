<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('razao_social')->nullable();
            $table->string('cpf_cnpj')->nullable();
            $table->string('ie')->nullable();
            $table->string('im')->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('site')->nullable();
            $table->unsignedInteger('endereco_id')->nullable();
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
        Schema::dropIfExists('empresas');
    }
}
