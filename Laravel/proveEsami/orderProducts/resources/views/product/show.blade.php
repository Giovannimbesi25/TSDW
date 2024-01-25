@extends('layout')
@section('content')
@if(isset($product))
    <h2>Modifica Elimina o Compra Prodotto</h2><br>
    <form method="post" action="/products/{{$product->id}}">
        @csrf 
        @method('PATCH')
        <label>Nome Prodotto</label>
        <input value="{{$product->nomeProdotto}}" name="nomeProdotto" type="text" required/><br><br>
        <label>Giacenza</label>
        <input value="{{$product->giacenza}}" name="giacenza" type="number" required/><br><br>
        <label>Prezzo</label>
        <input value="{{$product->prezzo}}"  name="prezzo" step="any" type="number" required/><br><br>
        <select name="order_id">
        @foreach($orders as $order)
            <option {{$order->id == $product->order_id ? 'selected' : ' '}} value="{{$order->id}}">{{$order->nomeUtente}} {{$order->cognomeUtente}}</option>
        @endforeach
    </select><br><br>
        <button type="submit">Modifica</button>
    </form><br>
    <form method="post" action="/products/{{$product->id}}">
        @csrf 
        @method('DELETE')
        <button type="submit">Elimina</button>
    </form><br><br>

    <h3>Compra prodotto</h3>
    <form method="post" action="/products/compra/{{$product->id}}">
        @csrf 
        <button type="submit">Compra</button>
    </form><br>
@else
    <h2>Prodotto non disponibile</h2>
@endif
@endsection