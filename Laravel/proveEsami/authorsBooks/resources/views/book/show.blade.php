@extends('layout')
@section('content')

@if(isset($book))
    <h1>Modifica o Elimina Libro</h1><br>

    <form method="post" action="/books/{{$book->id}}">
        @csrf 
        @method('PATCH')
        <input value="{{$book->id}}" type="hidden" name="id" required /><br><br>
        <label>Titolo</label>
        <input value="{{$book->titolo}}" type="text" name="titolo" required /><br><br>
        <label>Genere</label>
        <input value="{{$book->genere}}" type="text" name="genere" required /><br><br>
        <label>Pubblicazione</label>
        <input value="{{$book->pubblicazione}}" type="number" name="pubblicazione" required /><br><br>
        <label>Autore </label>
        <select name="author_id">
            @foreach($authors as $author)
                <option value="{{$author->id}}" {{$author->id == $book->author_id ? 'selected' : ''}}  >{{$author->nome}} {{$author->cognome}}</option>
            @endforeach
        </select><br><br>
        <button type="submit">Modifica Libro</button>
    </form>
    <br>
    <form method="post" action="/books/{{$book->id}}">
        @csrf 
        @method('DELETE')
        <button type="submit">Elimina Libro</button>
    </form>
@else
    <h2>Questo Libro non esiste</h2>
@endif
@endsection