@extends('layout')
@section('content')
<h2>Edit Task {{$task->id}}</h2>

<form action="/tasks/{{$task->id}}" method="post">
    @csrf
    @method('PATCH')
    <label>Title</label>
    <input type="text" value="{{$task->title}}" name="title">
    <br><br>
    <label>Title</label>
    <input type="text" value="{{$task->project_id}}" name="project_id">
    <br><br>
    <label>Description</label><br>
    <textarea type="text" cols=30 rows=10 name="description">{{$task->description}}</textarea>
    <br><br>
    <button type="submit">Update Task</button>
    <br>
</form><br>
<form action="/tasks/{{$task->id}}" method="post">
    @method('DELETE')
    @csrf
    <button type="submit">Delete Task</button>
</form>



@endsection