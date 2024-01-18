@extends('layout')
@section('content')
    @if( count($lettere) > 0)
        <h2>Elenco Lettere</h2>
        <br>
        <ul>
        @foreach($lettere as $lettera)
            <li>
               <h4><a href="/letteras/{{$lettera->id}}">Nome: {{$lettera->nome}}</a></h4>
               <form action="/letteras/consegna/{{$lettera->id}}" method="post">
                    @csrf
                    <button type="submit">Consegna</button>
                </form>
            </li>
        @endforeach
        </ul>

        <br><br>
        <a href="/letteras/befana/bonus">Arriva la befana</a>
    @else
        <h2>Non ci sono lettere</h2>
    @endif
    <br><br>
    <h3>Aggiungi una lettera</h3>

    <form method="post" action="/letteras">
        @csrf
        <label>Nome</label>
        <input type="text" required name="nome"/>
        <label>Quantità</label>
        <input type="text" required name="quantità"/>
        <button type="submit">Aggiungi</button>
    </form>
@endsection
