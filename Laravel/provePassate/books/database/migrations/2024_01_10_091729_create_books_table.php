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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn');
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->integer('ranking');
            $table->integer('year');
            $table->decimal('price');
            $table->timestamps();
        });


        DB::table('books')->insert([
            [
                'isbn' => '9789876543210',
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'author' => 'J.K. Rowling',
                'publisher' => 'Bloomsbury',
                'ranking' => 2,
                'year' => 1997,
                'price' => 24.99,
            ],
            [
                'isbn' => '9780123456789',
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'publisher' => 'J.B. Lippincott & Co.',
                'ranking' => 3,
                'year' => 1960,
                'price' => 14.99,
            ],
            [
                'isbn' => '9780451524935',
                'title' => '1984',
                'author' => 'George Orwell',
                'publisher' => 'Signet Classics',
                'ranking' => 4,
                'year' => 1949,
                'price' => 12.99,
            ],
            [
                'isbn' => '9780061120084',
                'title' => 'To Kill a Mockingbird',
                'author' => 'J.R.R. Tolkien',
                'publisher' => 'HarperCollins',
                'ranking' => 5,
                'year' => 1937,
                'price' => 29.99,
            ],
            [
                'isbn' => '9780142437219',
                'title' => 'Moby-Dick',
                'author' => 'Herman Melville',
                'publisher' => 'Penguin Classics',
                'ranking' => 6,
                'year' => 1851,
                'price' => 18.99,
            ],
        ]);
    
    }




    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
