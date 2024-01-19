@extends('layout')
@section('content')
<h2>Aggiungi una nuova classe</h2><br><br>
<form method="post" action="/classes">
    @csrf
    <label>Materia</label><br>
    <input type="text" required name="materia"><br>
    <label>Scuola</label><br>
    <input type="text" required name="scuola"><br>
    <label>Anno</label><br>
    <input type="number" required name="anno"><br>
    <button type="submit">Aggiungi</button>
</form>
@endsection