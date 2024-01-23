@extends('layout')
@section('content')

<h2>Aggiungi una categoria</h2><br>
<form method="post" action="/categories">
    @csrf 
    <label>Nome</label>
    <input type="text" required name="nome" /><br><br>
    <label>Descrizione</label><br>
    <textarea type="text" required name="descrizione" rows="10" cols="30"></textarea><br><br>
    <label>Anno Creazione</label>
    <input type="number" required name="creazione" /><br><br>
    <button type="submit">Aggiungi</button>
</form>
@endsection