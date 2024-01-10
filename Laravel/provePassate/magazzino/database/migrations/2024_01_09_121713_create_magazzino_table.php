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
        Schema::create('magazzinos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_prodotto');
            $table->integer('giacenza');
            $table->decimal('prezzo');
            $table->timestamps();
        });

        DB::table('magazzinos')->insert([
            [
                'nome_prodotto' => 'Prodotto A',
                'giacenza' => 10,
                'prezzo' => 29.99,
            ],
            [
                'nome_prodotto' => 'Prodotto B',
                'giacenza' => 5,
                'prezzo' => 19.99,
            ],
            [
                'nome_prodotto' => 'Prodotto C',
                'giacenza' => 15,
                'prezzo' => 39.99,
            ],
            [
                'nome_prodotto' => 'Prodotto D',
                'giacenza' => 8,
                'prezzo' => 24.99,
            ],
            [
                'nome_prodotto' => 'Prodotto E',
                'giacenza' => 12,
                'prezzo' => 34.99,
            ],
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magazzinos');
    }
};
