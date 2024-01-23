@extends('layout')
@section('content')
    <h2>Inserisci un nuovo Client</h2>
    <br>
    <form method="post" action="/clients">
        @csrf 
        <label>Nome</label>
        <input type="text" required name="nome" /><br><br>
        <label>Cognome</label>
        <input type="text" required name="cognome" /><br><br>
        <label>Età</label>
        <input type="number" required name="età" /><br><br>
        <button type="submit">Aggiungi</button>
    </form>
@endsection