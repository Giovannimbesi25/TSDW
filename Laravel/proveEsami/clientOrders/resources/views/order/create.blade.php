@extends('layout')
@section('content')
    <h2>Inserisci un nuovo Ordine</h2>
    <br>
    <form method="post" action="/orders">
        @csrf 
        <label>Data</label>
        <input type="date" required name="data" /><br><br>
        <label>Importo</label>
        <input type="number" required name="importo" /><br><br>
        <select name="client_id">
            @foreach($clients as $client)
            <option
                value="{{$client->id}}"
                >{{$client->nome}} {{$client->cognome}}
            </option>
            @endforeach
        </select><br><br>
        <button type="submit">Aggiungi</button>
    </form>
@endsection