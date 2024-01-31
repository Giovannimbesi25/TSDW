@extends('layout')
@section('content')
    <h2>Create New fiume</h2><br>

    <form method="post" action="/fiumes">
        @csrf
        <label>Nome</label>
        <input name="nome" type="text" required/><br><br>
        <label>Lunghezza(km)</label>
        <input name="lunghezza" step="any" type="number" required/><br><br>
        <label>Foce</label>
        <input name="foce" type="text" required/><br><br>
        
        <select name="continent_id">
            @foreach($continents as $continent)
                <option value="{{$continent->id}}">{{$continent->nome}}</option>
            @endforeach
        </select><br><br>
        <input type="submit" value="Aggiungi" />
    </form>
@endsection

