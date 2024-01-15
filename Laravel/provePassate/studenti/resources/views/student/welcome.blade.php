@extends('layout')
@section('content')
@if(count($students)>0)
    <h1>Ecco la lista degli studenti</h1>
    <ul>
        @foreach($students as $student)
            <li>
                <a href="{{route('student.about', $student->id)}}"><p>{{$student->nome}} {{$student->cognome}}</p></a>
            </li>
        @endforeach
    </ul>
@else
    <h1>La lista degli studenti è vuota</h1>
@endif
<br>
<br>
<h3>Aggiungi un nuovo studente</h3>
<form method="post" action="{{route('student.addStudent')}}">
    @csrf
    <label>Nome</label>
    <input type="text" name="nome" required>
    <label>Cognome</label>
    <input type="text" name="cognome" required>

    <label>Facoltà</label>
    <input type="text" name="facoltà" required>
    <label>Età</label>
    <input type="text" name="età" required>
    <button type="submit">Aggiungi</button>
</form> 
@endsection