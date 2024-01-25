@extends('layout')
@section('content')
<h2>Crea una nuovo Exam</h2>
<br>
<form method="post" action="/exams">
    @csrf
    <label>Corso</label>
    <input type="text" required name="corso" /><br><br>
    <label>Data</label>
    <input type="date" required name="data" /><br><br>
    <label>Voto</label>
    <input type="integer" required name="voto" /><br><br>
    <select name="career_id">
        @foreach($careers as $career)
        <option value="{{$career->id}}">{{$career->nomeStudente}} {{$career->cognomeStudente}}</option>
        @endforeach
    </select><br><br>
    <button type="submit">Aggiungi</button>
</form>
@endsection