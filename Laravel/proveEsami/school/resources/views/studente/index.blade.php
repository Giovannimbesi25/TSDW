@extends('layout')
@section('content')

@if(count($studenti) > 0)
    <h2>Elenco Studenti</h2>

    <ul>
        @foreach($studenti as $student)
            <li>
            <h4><a href="/students/{{$student->id}}">{{$student->nome}} {{$student->cognome}}</a></h4>
            </li>
            
        @endforeach
    </ul>
@else
    <h2>Non ci sono studenti</h2>
@endif
<form method="get" action="/students/create">
    <button type="submit">Aggiungi uno student</button>
</form>
@endsection