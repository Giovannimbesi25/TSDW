@extends('layout')
@section('content')
<h2>Crea il tuo task</h2>
<form method="post" action="/tasks">
    @csrf
    <label>Title</label>
    <input type="text" name="title">
    <br><br>
    <label>Description</label><br>
    <textarea type="text" cols=30 rows=10 name="description"></textarea>
    <br><br>
    <label>Project ID</label> 
    <input type="number" name="project_id" value="{{$project_id}}">
    <br><br>
    <button type="submit">CreateTask</button>
    <br>
</form>

@endsection