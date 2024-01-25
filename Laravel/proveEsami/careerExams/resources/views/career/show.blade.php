@extends('layout')
@section('content')
@if(isset($career))
    @if(count($career->exams)>0)
    <h2>Lista Esami</h2>
    <ul>
        @foreach($career->exams as $exam)
        <li>
            <h4>
                <a href="/exams/{{$exam->id}}">
                    {{$exam->corso}}
                </a>
            </h4>
            </li>
        @endforeach
        </ul>
    @else
        <h2>Non ci sono Esami</h2>
    @endif

    <h3>Modifica o Elimina Career</h3>
    <form method="post" action="/careers/{{$career->id}}">
        @csrf
        @method('PATCH')
        <label>Nome Studente</label>
        <input required value="{{$career->nomeStudente}}" type="text" name="nomeStudente" /><br><br>
        <label>Cognome Studente</label>
        <input required value="{{$career->cognomeStudente}}" type="text" name="cognomeStudente" /><br><br>
        <label>Matricola Studente</label>
        <input required value="{{$career->matricola}}" type="integer" name="matricola" /><br><br>
        <button type="submit">Modifica</button>
    </form>
    <br>
    <form method="post" action="/careers/delete/{{$career->id}}">
        @csrf
        @method('DELETE')
        <button type="submit">Elimina</button>
    </form>

@else
    <h2>Risorsa non disponibile</h2>
@endif

@endsection