@extends('layout')
@section('content')
    <h2>Update or Delete Fiume</h2><br>

    <form method="post" action="/fiumes/{{$fiume->id}}">
        @csrf
        @method('PATCH')
        <label>Nome</label>
        <input value="{{$fiume->nome}}" name="nome" type="text" required/><br><br>
        <label>Lunghezza(km)</label>
        <input value="{{$fiume->lunghezza}}" name="lunghezza" step="any" type="number" required/><br><br>
        <label>Foce</label>
        <input value="{{$fiume->foce}}" name="foce" type="text" required/><br><br>
        
        <select name="continent_id">
            @foreach($continents as $continent)
                <option {{$continent->id == $fiume->continent_id ? 'selected' : ''}} value="{{$continent->id}}">{{$continent->nome}}</option>
            @endforeach
        </select><br><br>
        <button type="submit">Modifica</button>
    </form>
    <br>
    <form method="post" action="/fiumes/{{$fiume->id}}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
