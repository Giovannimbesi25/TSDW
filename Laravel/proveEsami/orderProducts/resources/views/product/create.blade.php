@extends('layout')
@section('content')
<h2>Crea un nuovo ordine</h2><br>

<form method="post" action="/products">
    @csrf 
    <label>NomeProdotto</label>
    <input name="nomeProdotto" type="text" required/><br><br>
    <label>Giacenza</label>
    <input name="giacenza" type="number" required/><br><br>
    <label>Prezzo</label>
    <input name="prezzo" step="any" type="number" required/><br><br>
    <select name="order_id">
        @foreach($orders as $order)
            <option value="{{$order->id}}">{{$order->nomeUtente}} {{$order->cognomeUtente}}</option>
        @endforeach
    </select><br><br>
    <button type="submit">Aggiungi</button>
</form>

@endsection