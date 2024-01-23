@extends('layout')
@section('content')

<h2>Aggiungi un Libro</h2>
<form method="post" action="/books">
    @csrf 
    <label>Titolo</label>
    <input type="text" name="titolo" required /><br><br>
    <label>Genere</label>
    <input type="text" name="genere" required /><br><br>
    <label>Pubblicazione</label>
    <input type="number" name="pubblicazione" required /><br><br>
    <label>Autore </label>
    <select name="author_id">
        @foreach($authors as $author)
            <option {{$author->id == $inputAuthor ? 'selected' : ''}} value="{{$author->id}}">{{$author->nome}} {{$author->cognome}}</option>
        @endforeach
    </select><br><br>
    <button type="submit">Aggiungi</button>
</form>
@endsection