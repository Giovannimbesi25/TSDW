@extends('layout')
@section('content')

@if(count($clients)>0)
    <h2>Lista Clienti</h2>
        <ul>
        @foreach($clients as $client)
            <li>
                <h3>
                    <a href="/clients/{{$client->id}}">
                        {{$client->nome}} {{$client->cognome}}
                    </a>
                </h3>
            </li>
            <br>
        @endforeach
        </ul>
@else
    <h2>Non ci sono clienti</h2>
@endif
@endsection