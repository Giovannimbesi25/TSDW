@extends('layout')
@section('content')


@if(count($products)>0)
    <h2>Lista Prodotti</h2><br>
    <ul>
    @foreach($products as $product)
        <li>
            <h3><a href="/products/{{$product->id}}">{{$product->nome}}</a></h3>
        </li>
    @endforeach
    </ul>
@else
    <h2>Non ci sono prodotti al momento</h2>
@endif
    <br><br>
@endsection