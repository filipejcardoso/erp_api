<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecursosGrupoPapelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos_grupo_papels', function (Blueprint $table) {
            
            $table->increments('id');
            $table->unsignedInteger('recursos_grupo_id');
            $table->unsignedInteger('papels_id');
            $table->timestamps();

            $table->foreign('recursos_grupo_id')->references('id')->on('recursos_grupos');
            $table->foreign('papels_id')->references('id')->on('papels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        

        $table->dropForeign('recursos_grupo_papels_recursos_grupo_id_foreign');
        $table->dropForeign('recursos_grupo_papels_papels_id_foreign');

        Schema::dropIfExists('recursos_grupo_papels');
    }
}
