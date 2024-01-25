@extends('layout')
@section('content')
<h2>Crea una nuova Career</h2>
<br>
<form method="post" action="/careers">
    @csrf
    <label>Nome Studente</label>
    <input type="text" required name="nomeStudente" /><br><br>
    <label>Cognome Studente</label>
    <input type="text" required name="cognomeStudente" /><br><br>
    <label>Matricola Studente</label>
    <input type="integer" required name="matricola" /><br><br>
    <button type="submit">Aggiungi</button>
</form>
@endsection