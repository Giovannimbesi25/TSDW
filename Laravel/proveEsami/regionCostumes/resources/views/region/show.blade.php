@extends('layout')
@section('content')
@if(isset($region))
    @if(count($region->costumes)>0)
        <h2>Lista Costumes</h2>
        <ul>
            @foreach($region->costumes as $costume)
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
    <br>
    <h2>Update or Delete Region</h2><br>

    <form method="post" action="/regions/{{$region->id}}">
        @csrf
        @method('PATCH')
        <label>Name</label>
        <input value="{{$region->name}}" name="name" type="text" required/><br><br>
        <label>Country</label>
        <input value="{{$region->country}}" name="country" type="text" required/><br><br>
        <button button="submit">Modifica</button>
    </form><br>
    <form method="post" action="/regions/{{$region->id}}">
        @csrf
        @method('DELETE')
        <button button="submit">Delete</button>
    </form>


@else
    <h2>Questa Region non esiste</h2>
@endif
@endsection