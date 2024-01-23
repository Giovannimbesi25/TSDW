@extends('layout')
@section('content')
@if(isset($product))
    <h2>Modifica o Elimina Prodotto</h2><br>
    <form method="post" action="/products/{{$product->id}}">
        @method('PATCH')
        @csrf 
        <label>Nome</label>
        <input value="{{$product->nome}}" type="text" required name="nome" /><br><br>
        <label>Giacenza</label>
        <input value="{{$product->giacenza}}" type="number" required name="giacenza" /><br><br>
        <label>Prezzo</label>
        <input value="{{$product->prezzo}}" type="number" required name="prezzo" /><br><br>
        <label>Categoria</label>
        <select name="category_id">
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{$category->nome}}</option>
            @endforeach
        </select>

        <br><br>
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