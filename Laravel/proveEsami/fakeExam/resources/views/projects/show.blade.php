@extends('layout')
@section('content')
<h2>Show Project {{$project->id}}</h2>

<h3>TITLE: {{$project->title}}</h3>
<h3>DESCRIPTION: {{$project->description}}</h3>
@if ($project->tasks->count())
    <h2>Tasks:</h2>
    <ul>
    @foreach($project->tasks as $task)
        <li>
            <a href="/tasks/{{$task->id}}">{{$task->title}}</a>
        </li>
    @endforeach
    </ul>
@endif
<form action="/projects/{{$project->id}}/edit" method="get">
    <button type="submit">Edit/Delete Project</button>
</form>
<br><br>
<form action="/tasks/create" method="post">
    @csrf
    <input type="hidden" name="project_id" value="{{$project->id}}">
    <button type="submit">Create Task in this Project</button>
</form>

@endsection