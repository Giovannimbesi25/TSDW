@extends('layout')
@section('content')
<h1>Benvenuto!</h1>
<br><br>

<form method="get" action="/classes">
    <button type="submit">Show Classes</button>
</form>

<br><br>
<form method="get" action="/students">
    <button type="submit">Show Students</button>
</form>

<br><br>

@endsection