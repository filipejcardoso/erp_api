<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignConfigPedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('config_pedidos', function (Blueprint $table) {
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
        Schema::table('config_pedidos', function (Blueprint $table) {
            $table->dropForeign('config_pedidos_associado_id_foreign');
        });
    }
}
