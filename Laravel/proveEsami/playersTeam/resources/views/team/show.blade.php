@extends('layout')
@section('content')
@if(isset($team))
    <h2>Modifica o elimina il team</h2>
    <form method="post" action="/teams/{{$team->id}}">
        @csrf
        @method('PATCH')
        <label>Nome</label>
        <input value="{{$team->nome}}" name="nome" required type="text" />
        <label>Citta</label>
        <input value="{{$team->citta}}" name="citta" required type="text" />
        <label>Anno_Fondazione</label>
        <input value="{{$team->anno_fondazione}}" name="anno_fondazione" required type="text" />
        <button type="submit">Update</button>
    </form>    
    @if(count($team->players) > 0)
    <h2>Rosa</h2>
        <ul>
        @foreach($team->players as $player)
        <li>
            <h3>{{$player->nome}} {{$player->cognome}}</h3>
        </li>

        @endforeach
        </ul>
    @else
        <h2>Rosa non presente</h2>
    @endif
    <br><br>    
    <form method="post" action="/teams/{{$team->id}}">
        @csrf
        @method('DELETE')
        <button type="submit">Elimina Team</button>
    </form>  
@else
    <h1>Risorsa non trovata</h1>
@endif

  