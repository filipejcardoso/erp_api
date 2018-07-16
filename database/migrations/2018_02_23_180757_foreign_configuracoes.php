<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignConfiguracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuracoes', function (Blueprint $table) {
            $table->foreign('config_pedido_id')->references('id')->on('config_pedidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configuracoes', function (Blueprint $table) {
            $table->dropForeign('configuracoes_config_pedido_id_foreign');
        });
    }
}
