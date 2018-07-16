<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDimensaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dimensaos', function (Blueprint $table) {
            $table->increments('id');
            $table->float('peso',8,2);
            $table->float('altura',8,2);
            $table->float('largura',8,2);
            $table->float('comprimento',8,2);
            $table->float('diametro',8,2);
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
        Schema::dropIfExists('dimensaos');
    }
}
