<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $authors = Author::all();
        return view('book.create', compact('authors'));
    }

    public function author_create($inputAuthor = 0)
    {   
        $authors = Author::all();
        return view('book.create', compact('authors', 'inputAuthor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Book::create($request->all());
        return redirect("/books");
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $authors = Author::all();
        return view('book.show', compact('book','authors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $book->update($request->all());
        return redirect("/books/$book->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect("/books");
    }
}
