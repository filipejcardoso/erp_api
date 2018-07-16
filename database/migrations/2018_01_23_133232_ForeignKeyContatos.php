<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeyContatos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contatos', function (Blueprint $table) {
            $table->dropColumn('tipo');
            $table->unsignedInteger('tipos_contato_id');
            $table->foreign('tipos_contato_id')->references('id')->on('tipos_contatos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contatos', function (Blueprint $table) {
            $table->unsignedInteger('tipo');
            $table->dropForeign('contatos_tipos_contato_id_foreign');
            $table->dropColumn('tipos_contato_id');
        });
    }
}
