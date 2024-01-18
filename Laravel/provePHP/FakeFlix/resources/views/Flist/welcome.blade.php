@extends('layout')
@section('content')
    <h1>Benvenuto su FakeFlix</h1><br>
    @if($film)
        <h1>film consigliato: {{$film->titolo}}</h1>
    @else
        <h1>La lista dei film è vuota</h1>
    @endif
    <br>
    <form method="post" action="{{route('flist.search')}}">
        @csrf
        <h3>Regista <input type="text" name="regista"/></h3>
        <h3>Titolo <input type="text" name="titolo"/></h3>
        <button type="submit">Search</button>
    </form>
    <br>

    <form method="get" action="{{route('wlist.welcome')}}">
        <button type="submit">Mostra la Wlist</button>
    </form>
@endsection('content')