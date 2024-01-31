@extends('layout')
@section('content')
@if(count($continents)>0)
    <h2>List Continents</h2>
    <ul>
        @foreach($continents as $continent)
        <li>
            <h4>
                <a href="/continents/{{$continent->id}}">
                    {{$continent->nome}}
                </a>
            </h4>
        </li>
        @endforeach
    </ul>
@else
    <h2>Non ci sono continents</h2>
@endif
@endsection