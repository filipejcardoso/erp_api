<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dimensaos', function (Blueprint $table) {
            $table->decimal('peso')->nullable()->change();
            $table->decimal('altura')->nullable()->change();
            $table->decimal('largura')->nullable()->change();
            $table->decimal('comprimento')->nullable()->change();
            $table->decimal('diametro')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dimensaos', function (Blueprint $table) {
            $table->decimal('peso')->nullable(false)->change();
            $table->decimal('altura')->nullable(false)->change();
            $table->decimal('largura')->nullable(false)->change();
            $table->decimal('comprimento')->nullable(false)->change();
            $table->decimal('diametro')->nullable(false)->change(); 
        });
    }
}
