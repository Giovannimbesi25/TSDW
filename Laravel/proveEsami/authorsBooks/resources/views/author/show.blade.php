@extends('layout')
@section('content')

@if(isset($author))
    <h1>Modifica o Elimina Autore</h1><br>
    @if(count($author->books)>0)
        <h2>Lista Books</h2><br>
        <ul>
        @foreach($author->books as $book)
            <li>
                <h4>{{$book->titolo}}</h4>
            </li>
        @endforeach
        </ul>
        <form method="get" action="/books/author_create/{{$author->id}}">
            <button type="submit">Aggiungi un Libro</button>
        </form>
        <br>
    @else
        <h3>Non ci sono libri per questo authore</h3>
    @endif

    <form method="post" action="/authors/{{$author->id}}">
        @csrf 
        @method('PATCH')
        <input value="{{$author->id}}" type="hidden" name="id" required /><br><br>
        <label>Nome</label>
        <input value="{{$author->nome}}" type="text" name="nome" required /><br><br>
        <label>Cognome</label>
        <input value="{{$author->cognome}}" type="text" name="cognome" required /><br><br>
        <label>Età</label>
        <input value="{{$author->età}}" type="number" name="età" required /><br><br>
        <button type="submit">Modifica Autore</button>
    </form>
    <br>
    <form method="post" action="/authors/{{$author->id}}">
        @csrf 
        @method('DELETE')
        <button type="submit">Elimina Autore</button>
    </form>
@else
    <h2>Questo Autore non esiste</h2>
@endif
@endsection