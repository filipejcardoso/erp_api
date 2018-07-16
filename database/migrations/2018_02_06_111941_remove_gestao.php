<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveGestao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign('produtos_gestao_estoque_id_foreign');
            $table->dropColumn('gestao_estoque_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->unsignedInteger('gestao_estoque_id');
            $table->foreign('gestao_estoque_id')->references('id')->on('gestao_estoques');
        });
    }
}
