@extends('layout')
@section('content')
@if(isset($order))
    <h2>Modifica o Elimina Ordine</h2><br>
    <br>
    <form method="post" action="/orders/{{$order->id}}">
        @csrf 
        @method('PATCH')
        <label>Data</label>
        <input value="{{$order->data}}" type="date" required name="data" /><br><br>
        <label>Importo</label>
        <input value="{{$order->importo}}" type="number" required name="importo" /><br><br>
        <select name="client_id">
            @foreach($clients as $client)
            <option
                value="{{$client->id}}"
                {{$client->id == $order->client_id ? 'selected' : ''}} 
            >
                {{$client->nome}}  {{$client->cognome}}
            </option>
            @endforeach
        </select><br><br>
        <button type="submit">Modifica</button>
    </form>
    <form method="post" action="/orders/{{$order->id}}">
        @csrf 
        @method('DELETE')
        <button type="submit">Elimina</button>
    </form>

@else
    <h2>Questo Ordine non esiste</h2>
@endif
@endsection