@extends('layout')
@section('content')
@if(count($careers)>0)
<h2>List Careers</h2>
<ul>
    @foreach($careers as $career)
    <li>
        <h4>
            <a href="/careers/{{$career->id}}">
                {{$career->nomeStudente}} {{$career->cognomeStudente}}
            </a>
        </h4>
        </li>
    @endforeach
    </ul>
@else
    <h2>Non ci sono Carriere</h2>
@endif
@endsection