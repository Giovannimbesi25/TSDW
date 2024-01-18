@extends('layout')
@section('content')
    @if(isset($films))
        <ul>
            @foreach($films as $film)
                <li>
                    <p>{{$film->titolo}}</p>
                    <p>{{$film->regista}}</p>
                </li>
                <br>
            @endforeach
        </ul>
    
    @elseif($titolo != null && $regista != null)
        <h2>Nessun film trovato con questi valori, vuoi inserirlo?</h2>
        
        <form method="post" action="{{ route('wlist.insert')}}">
            @csrf
            <input type="hidden" name="titolo" value="{{ $titolo }}">
            <input type="hidden" name="regista" value="{{ $regista }}">
            <button type="submit">Si</button>
        </form>
        <form method="get" action="{{ route('flist.welcome') }}">
            @csrf
            <button type="submit">No</button>
        </form>  
    @else
        <h1>Nessun risultato con questi valori</h1>

    @endif
@endsection
