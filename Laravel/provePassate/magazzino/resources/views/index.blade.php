@extends('layout')
@section('content')
    <h2>Elenco Prodotti</h2>
    
    @if(count($prodotti) > 0)
        <ul>
            @foreach($prodotti as $prodotto)
                <li>
                    <p>{{ $prodotto->nome_prodotto }}</p>
                    <p>Giacenza: {{ $prodotto->giacenza }}</p>
                    <p>Prezzo: {{ $prodotto->prezzo }}</p>
                    <form method="post" action="{{route('magazzino.compra', $prodotto) }}" >
                        @csrf
                        <button type="submit">Compra</button>
                    </form>
                    <br>
                    <form method="post" action="{{route('magazzino.elimina', $prodotto) }}" >
                        @csrf
                        @method('DELETE')
                        <button type="submit">Elimina</button>
                    </form>
                    <br>
                </li>
            @endforeach
        </ul>
    @else
        <p>Nessun prodotto disponibile.</p>
    @endif

    <form method="post" action="{{route('magazzino.aggiungi') }}" >
        @csrf
        <h4>Nome_Prodotto: <input type="text" required name="nome_prodotto"></input></h4>
        <h4>Giacenza: <input type="number" required name="giacenza"></input></h4>
        <h4>Prezzo: <input type="number" required name="prezzo"></input></h4>
        <button type="submit">Aggiungi</button>
    </form>
@endsection
