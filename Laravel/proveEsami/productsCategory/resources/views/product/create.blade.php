@extends('layout')
@section('content')

<h2>Aggiungi un prodotto</h2><br>
<form method="post" action="/products">
    @csrf 
    <label>Nome</label>
    <input type="text" required name="nome" /><br><br>
    <label>Giacenza</label>
    <input type="number" required name="giacenza"></input><br><br>
    <label>Prezzo</label>
    <input type="number" required name="prezzo" /><br><br>
    <label>Categoria</label>
    <select name="category_id">
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->nome}}</option>
        @endforeach
    </select>
    <button type="submit">Aggiungi</button>
</form>
@endsection