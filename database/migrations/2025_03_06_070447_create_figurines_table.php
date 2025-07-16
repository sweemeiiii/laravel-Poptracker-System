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
        Schema::create('figurines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('series');
            $table->string('edition')->nullable();
            $table->string('imagePath')->nullable();
            $table->date('purchaseDate')->nullable();
            $table->string('condition')->nullable();
            $table->string('categories')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('figurines');
    }
};
