@extends('layout')
@section('content')
@if(count($players)>0)
    <h1>Numero giocatori {{count($players)}}</h1><br>
    <br>
    <ul>
        @foreach($players as $player)
        <li>
            <a href="/players/{{$player->id}}">{{$player->cognome}} {{$player->nome}}</a>
        </li>
        <br>
        @endforeach
    </ul>
@else
    <h1>Non ci sono giocatori</h1>
@endif

<form method="get" action="/players/create">
    <button type="submit">Aggiungi un giocatore</button>
</form>

@endsection