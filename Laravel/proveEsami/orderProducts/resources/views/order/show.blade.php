@extends('layout')
@section('content')
@if(isset($order))
    @if(count($order->products) > 0)
    <h2>Lista Prodotti</h2>
        @foreach($order->products as $product)
            <h4>
                {{$product->nomeProdotto}} 
            </h4>
        @endforeach
    @else
        <h2>Questo ordine non ha prodotti</h2>
    @endif
@else
    <h2>Questo Ordine non esiste</h2>
@endif

    <h2>Modifica o Elimina Ordine</h2><br>
    <form method="post" action="/orders/{{$order->id}}">
        @csrf 
        @method('PATCH')
        <label>NomeUtente</label>
        <input value="{{$order->nomeUtente}}" name="nomeUtente" type="text" required/><br><br>
        <label>CognomeUtente</label>
        <input value="{{$order->cognomeUtente}}" name="cognomeUtente" type="text" required/><br><br>
        <label>Data</label>
        <input value="{{$order->data}}"  name="data" type="date" required/><br><br>
        <button type="submit">Modifica</button>
    </form><br>
    <form method="post" action="/orders/{{$order->id}}">
        @csrf 
        @method('DELETE')
        <button type="submit">Elimina</button>
    </form><br>
@endsection