@extends('layout')
@section('content')
@if(count($regions)>0)
    <h2>Lista Regions</h2>
    <ul>
        @foreach($regions as $region)
        <li>
            <h4>
                <a href="/regions/{{$region->id}}">
                    {{$region->name}}
                </a>
            </h4>
        </li>
        @endforeach
    </ul>
@else
    <h2>Non ci sono Regions</h2>
@endif
@endsection