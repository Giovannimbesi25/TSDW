@extends('layout')
@section('content')
@if(isset($exam))

    <h3>Modifica o Elimina exam</h3>
    <form method="post" action="/exams/{{$exam->id}}">
        @csrf
        @method('PATCH')
        <label>Corso</label>
        <input required value="{{$exam->corso}}" type="text" name="corso" /><br><br>
        <label>Data</label>
        <input required value="{{$exam->data}}" type="date" name="data" /><br><br>
        <label>Voto</label>
        <input required value="{{$exam->voto}}" type="integer" name="voto" /><br><br>
        <select name="career_id">
        @foreach($careers as $career)
            <option {{$career->id == $exam->career->id ? 'selected' : ''}}
                value="{{$career->id}}">{{$career->nomeStudente}} {{$career->cognomeStudente}}</option>
        @endforeach
        </select><br><br>
        <button type="submit">Modifica</button>
    </form>
    <br>
    <form method="post" action="/exams/delete/{{$exam->id}}">
        @csrf
        @method('DELETE')
        <button type="submit">Elimina</button>
    </form>

@else
    <h2>Risorsa non disponibile</h2>
@endif

@endsection