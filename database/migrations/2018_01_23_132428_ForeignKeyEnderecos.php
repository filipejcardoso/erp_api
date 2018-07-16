<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeyEnderecos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropColumn('tipo');
            $table->unsignedInteger('tipos_endereco_id');
            $table->foreign('tipos_endereco_id')->references('id')->on('tipos_enderecos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->unsignedInteger('tipo');
            $table->dropForeign('enderecos_tipos_endereco_id_foreign');
            $table->dropColumn('tipos_endereco_id');
        });
    }
}
