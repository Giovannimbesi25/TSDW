@extends('layout')
@section('content')
<h2>Crea il tuo progetto</h2>
<form method="post" action="/projects">
    @csrf
    <label>Title</label>
    <input type="text" name="title">
    <br><br>
    <label>Description</label><br>
    <textarea type="text" cols=30 rows=10 name="description"></textarea>
    <br><br>
    <button type="submit">CreateProject</button>
    <br>
</form>

@endsection