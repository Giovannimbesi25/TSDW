@extends('layout')
@section('content')

@if(count($authors)>0)
<h2>Lista Autori</h2><br>
    <ul>
        @foreach($authors as $author)
        <li>
            <h4><a href="/authors/{{$author->id}}">{{$author->nome}} {{$author->cognome}}</a></h4>
        </li>
        <br>
        @endforeach
    </ul>
@else
    <h2>Non ci sono Autori</h2>
@endif
<br>
<form method="get" action="/authors/create">
    <button type="submit">Aggiungi Autore</button>
</form>
@endsection