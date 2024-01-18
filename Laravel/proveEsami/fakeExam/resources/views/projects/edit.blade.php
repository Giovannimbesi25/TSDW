@extends('layout')
@section('content')
<h2>Edit Project {{$project->id}}</h2>

<form action="/projects/{{$project->id}}" method="post">
    @csrf
    @method('PATCH')
    <label>Title</label>
    <input type="text" value="{{$project->title}}" name="title">
    <br><br>
    <label>Description</label><br>
    <textarea type="text" cols=30 rows=10 name="description">{{$project->description}}</textarea>
    <br><br>
    <button type="submit">Update Project</button>
    <br>
</form><br>

<form action="/projects/{{$project->id}}" method="post">
    @method('DELETE')
    @csrf
    <button type="submit">Delete Project</button>
</form>



@endsection