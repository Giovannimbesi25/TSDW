@extends('layout')
@section('content')
@if(count($fiumes)>0)
    <h2>Lista Fiumi</h2><br>
    <ul>
        @foreach($fiumes as $fiume)
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
    <h2>Non ci sono Fiumi</h2>
@endif
@endsection