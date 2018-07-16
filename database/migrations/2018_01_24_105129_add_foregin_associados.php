<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeginAssociados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('info_financeiras', function (Blueprint $table) {
            $table->unsignedInteger('associado_id')->nullable();
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
        Schema::table('info_financeiras', function (Blueprint $table) {
            $table->dropForeign('info_financeiras_associado_id_foreign');
            $table->dropColumn('associado_id');
        });
    }
}
