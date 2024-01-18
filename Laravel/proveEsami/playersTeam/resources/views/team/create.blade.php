@extends('layout')
@section('content')
<h1>Aggiungi un nuovo Team</h1>
<form method="post" action="/teams">
    @csrf
    <label>Nome</label><br>
    <input type="text" name="nome" required><br>
    <label>Città</label><br>
    <input type="text" name="citta" required><br>
    <label>Anno_Fondazione</label><br>
    <input type="integer" name="anno_fondazione" required><br>
    <button type="submit">Aggiungi</button>
</form>