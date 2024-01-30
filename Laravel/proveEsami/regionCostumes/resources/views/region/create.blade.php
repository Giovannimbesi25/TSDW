@extends('layout')
@section('content')
    <h2>Create New Region</h2><br>

    <form method="post" action="/regions">
        @csrf
        <label>Name</label>
        <input name="name" type="text" required/><br><br>
        <label>Country</label>
        <input name="country" type="text" required/><br><br>
        <button type="submit" >Aggiungi</button>
    </form>
@endsection