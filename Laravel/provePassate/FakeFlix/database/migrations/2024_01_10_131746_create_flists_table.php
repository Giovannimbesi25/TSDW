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
        Schema::create('flists', function (Blueprint $table) {
            $table->string('titolo');
            $table->string('regista');
            $table->timestamps(); 
        });

        DB::table('flists')->insert([
            ['titolo' => 'Il Padrino', 'regista' => 'Francis Ford Coppola'],
            ['titolo' => 'Inception', 'regista' => 'Christopher Nolan'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flists');
    }
};
