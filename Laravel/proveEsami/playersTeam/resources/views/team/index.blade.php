@extends('layout')
@section('content')

@if(count($teams) > 0)
    <h2>Lista Teams</h2>
    <ul>
        @foreach($teams as $team)
        <li>
            <a href="/teams/{{$team->id}}">{{$team->nome}}</a>
        </li>
        <br>
        @endforeach
    </ul>
@else
    <h2>Non ci sono squadre registrate</h2>
@endif
<br><br>
<form method="get" action="/teams/create">
    <button type="submit">Aggiungi un Team</button>
</form>
@endsection

