@extends('layout')
@section('content')

<h1>Projects Operations</h1>

<form method="get" action="/projects">
    <label>Show all projects</label>
    <button type="submit">SHOW</button>
</form>
<br>
<form method="get" action="/projects/create">
<label>Create a project</label>
    <button type="submit">Create</button>
</form>
<br>
<form method="post" action="/projects/help_show">
    @csrf
    <label>Search a project by ID</label>
    <input type="number" name="id"/>
    <button type="submit">Search</button>
</form>

<br>
<form method="post" action="/projects">
    @csrf
    @method('DELETE')
    <label>Delete all projects</label>
    <button type="submit">Delete</button>
</form>
<br><br>
<h1>Tasks Operations</h1>

<form method="get" action="/tasks">
    <label>Show all tasks</label>
    <button type="submit">SHOW</button>
</form>
<br>
<form method="get" action="/tasks/create">
<label>Create a task</label>
    <button type="submit">Create</button>
</form>
<br>
<form method="post" action="/tasks/help_show">
    @csrf
    <label>Search a task by ID</label>
    <input type="number" name="id"/>
    <button type="submit">Search</button>
</form>

<br>
<form method="post" action="/tasks">
    @csrf
    @method('DELETE')
    <label>Delete all tasks</label>
    <button type="submit">Delete</button>
</form>
@endsection