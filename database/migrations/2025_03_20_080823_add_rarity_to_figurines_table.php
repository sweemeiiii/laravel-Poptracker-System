<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('figurines', function (Blueprint $table) {
            $table->enum('rarity', ['common', 'secret', 'super secret'])->default('common')->after('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('figurines', function (Blueprint $table) {
            $table->dropColumn('rarity');
        });
    }
};
