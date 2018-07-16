<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManyToManyTiposAssociados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associados_tipos_associados', function (Blueprint $table) {
            $table->integer('associado_id')->unsigned()->nullable();
            $table->foreign('associado_id')->references('id')->on('associados')->onDelete('cascade');

            $table->integer('tipos_associado_id')->unsigned()->nullable();
            $table->foreign('tipos_associado_id')->references('id')->on('tipos_associados')->onDelete('cascade');

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
        Schema::dropIfExists('associados_tipos_associados');
    }
}
