@extends('layout')
@section('content')
<h2>Show Task {{$task->id}}</h2>

<h3>TITLE: {{$task->title}}</h3>
<h3>DESCRIPTION: {{$task->description}}</h3>
<h3>PROJECT_ID: {{$task->project_id}}</h3>

<form action="/tasks/{{$task->id}}/edit" method="get">
    <button type="submit">Edit/Delete Task</button>
</form>

@endsection