@extends('layout')
@section('content')

@if(count($classes) > 0)
    <h2>Lista classi</h2>
    <ul>
    @foreach($classes as $class)
        <li>
            <a href="/classes/{{$class->id}}">{{$class->materia}}</a>
        </li>
        <br>
    @endforeach
    </ul>
@else
    <h2>Non ci sono classi</h2>
@endif

<br><br>

<form action="/classes/create">
    <button type="submit">Aggiungi una nuova class</button>
</form>

@endsection