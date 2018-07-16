<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('recurso');
            $table->unsignedInteger('recursos_grupo_id');
            $table->timestamps();

            $table->foreign('recursos_grupo_id')->references('id')->on('recursos_grupos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        $table->dropForeign('recursos_recursos_grupo_id_foreign');
        
        Schema::dropIfExists('recursos');
    }
}
