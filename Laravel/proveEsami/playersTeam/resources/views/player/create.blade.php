@extends('layout')
@section('content')
<h1>Aggiungi un giocatore</h1><br>

<form method="post" action="/players">
    @csrf
    <label>Nome</label>
    <input name="nome" type="text" /><br>
    <label>Cognome</label>
    <input name="cognome" type="text" /><br>
    <label>Età</label>
    <input name="età" type="integer" /><br>
    <label>Squadra</label>
    <input name="team_id" value="{{$team_id}}" type="text" /><br>
    <button type="submit">Aggiungi</button>
</form>

@endsection