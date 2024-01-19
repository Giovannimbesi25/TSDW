@extends('layout')
@section('content')
<h2>Crea un nuovo studente</h2><br>
<form method="post" action="/students">
    @csrf 
    <label>Nome</label><br>
    <input type="text" required name="nome" /><br><br>
    <label>Cognome</label><br>
    <input type="text" required name="cognome" /><br><br>
    <label>Età</label><br>
    <input type="text" required name="età" /><br><br>
    <label>Classe</label><br>
    <input type="text" required value="{{$class_id}}" name="class_id" /><br><br>
    <button type="submit">Aggiungi</button>
</form>
@endsection