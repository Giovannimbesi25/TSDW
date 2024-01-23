@extends('layout')
@section('content')

<h2>Aggiungi un Authore</h2>
<form method="post" action="/authors">
    @csrf 
    <label>Nome</label>
    <input type="text" name="nome" required /><br><br>
    <label>Cognome</label>
    <input type="text" name="cognome" required /><br><br>
    <label>Età</label>
    <input type="number" name="età" required /><br><br>
    <button type="submit">Aggiungi</button>
</form>
@endsection