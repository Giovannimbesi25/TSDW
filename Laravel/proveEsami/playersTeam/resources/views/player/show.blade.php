@extends('layout')
@section('content')
@if(isset($player))

    <h2>Update or Delete Player</h2>
    <form method="post" action="/players/{{$player->id}}">
        @csrf 
        @method('PATCH')
        <label>Nome</label><br>
        <input name="nome" value="{{$player->nome}}" required type="text" /><br><br>
        <label>Cognome</label><br>
        <input name="cognome" value="{{$player->cognome}}" required type="text" /><br><br>
        <label>Età</label><br>
        <input name="età" value="{{$player->età}}" required type="number" /><br><br>
        <label>Squadra</label><br>
        <input name="team_id" value="{{$player->team_id}}" required type="number" /><br><br>
        <button type="submit">Update Player</button>
    </form>
    <br>
    <form method="post" action="/players/delete/{{$player->id}}">
        @csrf 
        @method('DELETE')
        <button type="submit">Delete Player</button>
    </form>
@else
    <h2>Player not exist</h2>
@endif
@endsection