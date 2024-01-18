@extends('layout')
@section('content')
@if(isset($student))
    <h1>Welcome {{$student->nome}}</h1>
    <br>

    <form method="post" action="{{route('student.editStudent')}}">
        @csrf
        <input type="hidden" name="id" required value="{{$student->id}}">
        <label>Nome</label>
        <input type="text" name="nome" required value="{{$student->nome}}">
        <label>Cognome</label>
        <input type="text" name="cognome" value="{{$student->cognome}}" required>
        <label>Facoltà</label>  
        <input type="text" name="facoltà" value="{{$student->facoltà}}" required>
        <label>Età</label>
        <input type="text" name="età" value="{{$student->età}}" required>
        <button type="submit">Update</button>
    </form>

    <br><br>
    <form method="post" action="{{route('student.deleteStudent', $student->id)}}">
        @csrf
        <span>Elimina questo studente </span>
        <button type="submit">Delete</button>
    </form>

@else
    <h1>Questo studente non esiste</h1>
@endif


@endsection