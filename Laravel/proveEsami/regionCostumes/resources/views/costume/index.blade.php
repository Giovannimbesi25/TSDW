@extends('layout')
@section('content')
@if(count($costumes)>0)
    <h2>Lista Costumes</h2><br>
    <ul>
        @foreach($costumes as $costume)
        <li>
            <h4>
                <a href="/costumes/{{$costume->id}}">
                    {{$costume->name}}
                </a>
            </h4>
        </li>
        @endforeach
    </ul>
@else
    <h2>Non ci sono Costumes</h2>
@endif
@endsection