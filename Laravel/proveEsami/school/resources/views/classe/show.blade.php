@extends('layout')
@section('content')

@if(isset($class))
    @if($class->studentes->count() > 0)
        <h2>Studenti class</h2>
        <ul>
        @foreach($class->studentes as $studente)
        <li>
            <p>{{$studente->nome}} {{$studente->cognome}}</p>
        </li>
        <br>
        @endforeach
        </ul>
    @endif
    <br>
    <form method="post" action="/students/create">
        @csrf 
        <input type="hidden" value="{{$class->id}}" name="class_id"/>
        <button type="submit">Aggiungi Studente</button>
    </form>
    <br><br>
    <h2>Modifica/Elimina class</h2>
    <br>
    <form method="post" action="/classs/{{$class->id}}">
        @csrf
        @method('PATCH')
        <label>Materia</label><br>
        <input type="text" name="materia" value="{{$class->materia}}" /><br><br>
        <label>Scuola</label><br>
        <input type="text" name="scuola" value="{{$class->scuola}}" /><br><br>
        <label>Anno</label><br>
        <input type="text" name="anno" value="{{$class->anno}}" /><br><br>
        <button type="submit">Modifica</button>
    </form>
    <br>
    <form method="post" action="/classs/{{$class->id}}">
        @csrf 
        @method('DELETE')
        <button type="submit">Elimina</button>
    </form>

@else
    <h2>La class non esiste</h2>
@endif

@endsection