<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estoques', function (Blueprint $table) {
            $table->string('area')->nullable()->change();
            $table->string('rua')->nullable()->change();
            $table->string('modulo')->nullable()->change();
            $table->string('nivel')->nullable()->change();
            $table->string('vao')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estoques', function (Blueprint $table) {
            $table->string('area')->nullable(false)->change();
            $table->string('rua')->nullable(false)->change();
            $table->string('modulo')->nullable(false)->change();
            $table->string('nivel')->nullable(false)->change();
            $table->string('vao')->nullable(false)->change();

        });
    }
}
