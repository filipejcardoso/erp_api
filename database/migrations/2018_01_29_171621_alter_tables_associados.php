<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablesAssociados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('associados_tipos_associados');
        Schema::dropIfExists('tipos_associados');
        Schema::table('associados', function (Blueprint $table) {
            $table->unsignedInteger('tipo_associado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('tipos_associados', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('codigo');
            $table->string('nome');
            $table->timestamps();
        });

        Schema::create('associados_tipos_associados', function (Blueprint $table) {
            $table->integer('associado_id')->unsigned()->nullable();
            $table->foreign('associado_id')->references('id')->on('associados')->onDelete('cascade');

            $table->integer('tipos_associado_id')->unsigned()->nullable();
            $table->foreign('tipos_associado_id')->references('id')->on('tipos_associados')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::table('associados', function (Blueprint $table) {
            $table->dropColumn('tipo_associado');
        });
    }
}
