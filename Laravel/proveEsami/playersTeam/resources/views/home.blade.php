@extends('layout')
@section('content')
<h1>Benvenuto</h1><br>
<form method="get" action="/players">
    <button type="submit">Mostra giocatori</button>
</form>
<br><br>

<form method="get" action="/teams">
    <button type="submit">Mostra Teams</button>
</form>
@endsection