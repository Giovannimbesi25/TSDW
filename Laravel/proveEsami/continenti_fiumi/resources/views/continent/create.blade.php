@extends('layout')
@section('content')
    <h2>Create New Continent</h2><br>

    <form method="post" action="/continents">
        @csrf
        <label>Nome</label>
        <input name="nome" type="text" required/><br><br>
        <label>Area(m2)</label>
        <input  name="area" step="any" type="number" required/><br><br>
        <button type="submit" >Aggiungi</button>
    </form>
@endsection