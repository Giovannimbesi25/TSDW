@extends('layout')
@section('content')

@if(isset($student))
    
    <h2>Modifica/Elimina student</h2>
    <br>
    <form method="post" action="/students/{{$student->id}}">
        @csrf
        @method('PATCH')
        <label>Materia</label><br>
        <input type="text" name="nome" value="{{$student->nome}}" /><br><br>
        <label>Scuola</label><br>
        <input type="text" name="cognome" value="{{$student->cognome}}" /><br><br>
        <label>Anno</label><br>
        <input type="text" name="età" value="{{$student->età}}" /><br><br>
        <label>Classe</label><br>
        <input type="text" name="class_id" value="{{$student->class_id}}" /><br><br>
        <button type="submit">Modifica</button>
    </form>
    <br>
    <form method="post" action="/students/{{$student->id}}">
        @csrf 
        @method('DELETE')
        <button type="submit">Elimina</button>
    </form>

@else
    <h2>La classe non esiste</h2>
@endif

@endsection