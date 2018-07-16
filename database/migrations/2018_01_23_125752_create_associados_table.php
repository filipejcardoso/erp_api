<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associados', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tipo');
            $table->unsignedInteger('situacao')->nullable();
            $table->string('nome');
            $table->string('email')->nullable();
            $table->string('cpf_cnpj')->nullable();
            $table->string('rg')->nullable();
            $table->string('razao_social')->nullable();
            $table->string('ie')->nullable();
            $table->string('im')->nullable();
            $table->string('telefone_comercial')->nullable();
            $table->string('telefone_celular')->nullable();
            $table->string('FAX')->nullable();
            $table->string('data_nascimento')->nullable();
            $table->unsignedInteger('tipo_contribuinte')->nullable();
            $table->string('site')->nullable();
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
        Schema::dropIfExists('associados');
    }
}
