<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignAssociadosGrupos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('associados', function (Blueprint $table) {
            $table->unsignedInteger('grupos_associado_id')->nullable()->after('situacao');
            $table->foreign('grupos_associado_id')->references('id')->on('grupos_associados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('associados', function (Blueprint $table) {
            $table->dropForeign('associados_grupos_associado_id_foreign');
            $table->dropColumn('grupos_associado_id');
        });
    }
}
