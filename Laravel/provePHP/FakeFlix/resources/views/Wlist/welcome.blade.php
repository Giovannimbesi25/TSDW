@extends('layout')
@section('content')
    @if(count($films)>0)
        <h2>La tua Wlist</h2><br>
        <ul>
            @foreach($films as $film)
                <li>
                    <p>{{$film->titolo}}</p>
                    <p>{{$film->regista}}</p>
                </li>
                <br>
            @endforeach
        </ul>
        <br><br>
        <form method="post" action="{{route('wlist.truncate')}}">
            @csrf
            <button type="submit">Svuota la Wlist</button>
        </form>
    @else
        <h2>La Wlist è vuota</h2>
    @endif
@endsection('content')