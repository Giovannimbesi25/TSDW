@extends('layout')
@section('content')
@if(isset($category))
    @if(count($category->products))
        <h2>Prodotti per questa categoria</h2><br>
        <ul>
        @foreach($category->products as $product)
            <li>
                <h3>{{$product->nome}}</h3>
            </li>
        @endforeach
        </ul>
    @else
        <h2>Non ci sono prodotti per questa categoria</h2><br>
    @endif

    <br><br>

    <h2>Modifica o Elimina Categoria</h2><br>
    <form method="post" action="/categories/{{$category->id}}">
        @method('PATCH')
        @csrf 
        <label>Nome</label>
        <input value="{{$category->nome}}" type="text" required name="nome" /><br><br>
        <label>Descrizione</label><br>
        <textarea type="text" required name="descrizione" rows="10" cols="30">{{$category->descrizione}}</textarea><br><br>
        <label>Anno Creazione</label>
        <input value="{{$category->creazione}}" type="number" required name="creazione" /><br><br>
        <button type="submit">Modifica</button>
    </form>
    <br><br>
    <form method="post" action="/categories/{{$category->id}}">
        @method('DELETE')
        @csrf 
        <button type="submit">Elimina</button>
        <br><br>
    </form>

    @else
    <h2>Non ci sono categorie al momento</h2>
@endif
@endsection