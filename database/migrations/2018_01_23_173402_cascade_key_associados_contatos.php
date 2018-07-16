<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CascadeKeyAssociadosContatos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contatos', function (Blueprint $table) {
            $table->dropForeign('contatos_associado_id_foreign');
            $table->foreign('associado_id')->references('id')->on('associados')->onDelete('cascade');
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
            $table->dropForeign('contatos_associado_id_foreign');
            $table->foreign('associado_id')->references('id')->on('associados');
        });
    }
}
