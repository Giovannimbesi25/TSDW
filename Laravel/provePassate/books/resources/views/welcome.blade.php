@extends('layout')
@section('content')
<h2>Benvenuto nella tua libreria</h2>
<h4>Premi il pulsante per vedere la lista dei libri</h4>
<form method="get" action="{{route('book.list')}}">
    <button type="submit">Lista libri</button>
</form>

@endsection