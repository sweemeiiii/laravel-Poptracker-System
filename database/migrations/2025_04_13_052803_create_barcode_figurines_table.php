<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('barcode_figurines', function (Blueprint $table) {
        $table->id();
        $table->string('barcode')->unique();
        $table->string('name');
        $table->string('series');
        $table->string('edition');
        $table->timestamps();
    });
    
    // Insert seed data manually
    DB::table('barcode_figurines')->insert([
        [
            'barcode' => '1234567890',
            'name' => 'Good Girl',
            'series' => 'CRYBABY',
            'edition' => 'Crybaby Crying Parade Series Figures',
        ],
        [
            'barcode' => '0987654321',
            'name' => 'Crazy Friday',
            'series' => 'THE MONSTERS',
            'edition' => 'THE MONSTERS Mischief Diary Series Figures',
        ],
        [
            'barcode' => '1122334455',
            'name' => 'Foodie Giraffe',
            'series' => 'DIMOO',
            'edition' => 'DIMOO Animal Kingdom Series Figures',
        ],
    ]);
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barcode_figurines');
    }
};
