<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CascadeKeyAssociados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referencias_bancarias', function (Blueprint $table) {
            $table->dropForeign('referencias_bancarias_associado_id_foreign');
            $table->foreign('associado_id')->references('id')->on('associados')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('referencias_bancarias', function (Blueprint $table) {
            $table->dropForeign('referencias_bancarias_associado_id_foreign');
            $table->foreign('associado_id')->references('id')->on('associados');
        });
    }
}
