@extends('layout')
@section('content')
<h2>Crea un nuovo ordine</h2><br>

<form method="post" action="/orders">
    @csrf 
    <label>NomeUtente</label>
    <input name="nomeUtente" type="text" required/><br><br>
    <label>CognomeUtente</label>
    <input name="cognomeUtente" type="text" required/><br><br>
    <label>Data</label>
    <input name="data" type="date" required/><br><br>
    <button type="submit">Aggiungi</button>
</form>

@endsection