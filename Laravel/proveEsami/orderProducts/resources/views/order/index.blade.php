@extends('layout')
@section('content')
@if(count($orders) > 0)
<h2>Lista Ordini</h2>
    <ul>
    @foreach($orders as $order)
    <li>
        <h4>
            <a href="/orders/{{$order->id}}">
                {{$order->nomeUtente}} {{$order->cognomeUtente}}
            </a>
        </h4>
    </li>
    @endforeach
    </ul>
@else
    <h2>Non ci sono ordini</h2>
@endif
@endsection