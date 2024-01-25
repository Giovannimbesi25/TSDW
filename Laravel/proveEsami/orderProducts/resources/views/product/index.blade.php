@extends('layout')
@section('content')
@if(count($products) > 0)
<h2>Lista Prodotti</h2>
    <ul>
    @foreach($products as $product)
        <li>
            <h4>
                <a href="/products/{{$product->id}}">
                    {{$product->nomeProdotto}} 
                </a>
            </h4>
        </li>
    @endforeach
    </ul>
@else
    <h2>Non ci sono Prodotti</h2>
@endif
@endsection