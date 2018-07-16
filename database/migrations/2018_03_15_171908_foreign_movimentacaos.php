<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignMovimentacaos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movimentacaos', function (Blueprint $table) {
            $table->foreign('caixa_id')->references('id')->on('caixas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimentacaos', function (Blueprint $table) {
            $table->dropForeign('movimentacaos_caixa_id_foreign');
        });
    }
}
