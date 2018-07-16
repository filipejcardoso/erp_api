<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropForeign('enderecos_regiao_foreign');
            $table->dropColumn('regiao');

            $table->unsignedInteger('regioes_id')->nullable()->after('complemento');
            $table->foreign('regioes_id')->references('id')->on('regioes');
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
            $table->dropForeign('enderecos_regioes_id_foreign');
            $table->dropColumn('regioes_id');

            $table->unsignedInteger('regiao')->nullable()->after('complemento');
            $table->foreign('regiao')->references('id')->on('regioes');
        });
    }
}
