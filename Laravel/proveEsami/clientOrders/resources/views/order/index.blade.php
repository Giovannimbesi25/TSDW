@extends('layout')
@section('content')

@if(count($orders)>0)
    <h2>Lista Ordini</h2>
        <ul>
        @foreach($orders as $order)
            <li>
                <h3>
                    <a href="/orders/{{$order->id}}">
                        {{$order->data}} 
                    </a>
                </h3>
            </li>
            <br>
        @endforeach
        </ul>
@else
    <h2>Non ci sono Ordini</h2>
@endif
@endsection