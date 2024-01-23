@extends('layout')
@section('content')
@if(isset($client))
    <h2>Modifica o Elimina Client</h2><br>
    @if(count($client->orders)>0)
        <h3>Lista Ordini</h3>
            <ul>
            @foreach($client->orders as $order)
                <li>
                    <h4>
                        {{$order->data}}
                    </h4>
                </li>
                
            @endforeach
            </ul>
    @else
        <h3>Non ci sono ordini per questo Cliente</h3>
    @endif

    <br>
    <form method="post" action="/clients/{{$client->id}}">
        @csrf 
        @method('PATCH')
        <label>Nome</label>
        <input value="{{$client->nome}}" type="text" required name="nome" /><br><br>
        <label>Cognome</label>
        <input value="{{$client->cognome}}" type="text" required name="cognome" /><br><br>
        <label>Età</label>
        <input value="{{$client->età}}" type="number" required name="età" /><br><br>
        <button type="submit">Modifica</button>
    </form>
    <form method="post" action="/clients/{{$client->id}}">
        @csrf 
        @method('DELETE')
        <button type="submit">Elimina</button>
    </form>

@else
    <h2>Questo Cliente non esiste</h2>
@endif
@endsection