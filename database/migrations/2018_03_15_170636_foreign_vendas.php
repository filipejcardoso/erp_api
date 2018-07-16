<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->foreign('caixa_id')->references('id')->on('caixas');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('associado_id')->references('id')->on('associados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendas', function (Blueprint $table) {
            $table->dropForeign('vendas_caixa_id_foreign');
            $table->dropForeign('vendas_user_id_foreign');
            $table->dropForeign('vendas_associado_id_foreign');
        });
    }
}
