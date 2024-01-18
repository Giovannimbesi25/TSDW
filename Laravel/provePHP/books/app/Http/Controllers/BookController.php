<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
class BookController extends Controller
{
    public function list(){
        $books = Book::all();
        return view('list', compact('books'));
    }

    public function aggiungi(Request $request){
        $book = $request->all();
        Book::create($book);
        return redirect('/books');
    }

    public function detail($id){
        $book = Book::find($id);
        //oppure ->get()  
        //oppure Book::where('id',$id)->first();
        return view('detail', compact('book'));
    }

    public function update(Request $request, Book $book){
        $book->update($request->all());   
        return redirect()->route('book.detail', $book->id);
    }

    public function delete(Book $book){
        $book->delete();
        return redirect()->route('book.list');
    }
}

