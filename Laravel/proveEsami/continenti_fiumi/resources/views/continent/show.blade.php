@extends('layout')
@section('content')
@if(isset($continent))
    @if(count($continent->fiumes)>0)
        <h2>Fiumi di questo Continente</h2>
        <ul>
            @foreach($continent->fiumes as $fiume)
            <li>
                <h4>
                    <a href="/fiumes/{{$fiume->id}}">
                        {{$fiume->nome}}
                    </a>
                </h4>
            </li>
            @endforeach
        </ul>
    @else
        <h2>Non ci sono Fiumi per questo continente</h2>
    @endif
    <br>
    <h2>Update or Delete Continent</h2><br>

    <form method="post" action="/continents/{{$continent->id}}">
        @csrf
        @method('PATCH')
        <label>Nome</label>
        <input value="{{$continent->nome}}" name="nome" type="text" required/><br><br>
        <label>Area(m2)</label>
        <input value="{{$continent->area}}" name="area" step="any" type="number" required/><br><br>
        <button button="submit">Modifica</button>
    </form><br>
    <form method="post" action="/continents/{{$continent->id}}">
        @csrf
        @method('DELETE')
        <button button="submit">Delete</button>
    </form>


@else
    <h2>Questo Continent non esiste</h2>
@endif
@endsection