<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('figurines', function (Blueprint $table) {
            $table->enum('status', ['owned', 'wishlist', 'duplicate'])->default('owned');
        });
    }

    public function down()
    {
        Schema::table('figurines', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
