@extends('layout')
@section('content')

@if(count($books)>0)
<h2>Lista Libri</h2><br>
    <ul>
        @foreach($books as $book)
        <li>
            <h4><a href="/books/{{$book->id}}">{{$book->titolo}}</a></h4>
        </li>
        
        @endforeach
    </ul>
@else
    <h2>Non ci sono Libri</h2>
@endif
<br>
<form method="get" action="/books/create">
    <button type="submit">Aggiungi Book</button>
</form>
@endsection