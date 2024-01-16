@extends('layout')
@section('content')
    @if(isset($lettera))
        <h2>About Page</h2>

        <form method="post" action="/letteras/{{$lettera->id}}">
            @csrf
            @method('PUT')
            <input type="text" name="nome" required value="{{$lettera->nome}}" />
            <input type="text" name="quantità" required value="{{$lettera->quantità}}" />
            <input type="number" name="consegna" required value="{{$lettera->consegnata}}" />
            <button type="submit">Update</button>
        </form>
        
        <form method="post" action="/letteras/{{$lettera->id}}">
            @csrf
            @method('DELETE')
            <button type="submit">Elimina la lettera</button>
        </form>    
    @else
        <h2>Questa lettera non esiste</h2>
    @endif

@endsection
