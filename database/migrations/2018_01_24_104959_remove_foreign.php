<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('associados', function (Blueprint $table) {
            $table->dropForeign('associados_info_financeira_id_foreign');
            $table->dropColumn('info_financeira_id');
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
            $table->unsignedInteger('info_financeira_id')->nullable();
            $table->foreign('info_financeira_id')->references('id')->on('info_financeiras');
        });
    }
}
