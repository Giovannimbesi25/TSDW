@extends('layout')
@section('content')

    @if(count($prodotti)>0)
        <h1>Elenco prodotti</h1>
        <ul>
        @foreach($prodotti as $prodotto)
            <li>
                <h4>Nome_Prodotto: {{$prodotto->nome_prodotto}}</h4>
                <h4>Giacenza: {{$prodotto->giacenza}}</h4>
                <h4>Prezzo: {{$prodotto->prezzo}}</h4>
                
                <div style="display: flex; gap: 10px">
                    <form method="post" action="/prodotti/{{$prodotto->id}}">
                        @csrf
                        @method('PUT')
                        <button type="submit">Compra</button>
                    </form>
                    <form method="post" action="/prodotti/{{$prodotto->id}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            </li>
            <br>
        @endforeach
        </ul>
    @else
        <h1>Nessun prodotto nel magazzino</h1>
    @endif

    
    <h3>Aggiungi un prodotto</h3>
    <form method="post" action="/prodotti" >
        @csrf
        <label>Nome_Prodotto</label>
        <input type="text" name="nome_prodotto" required/>
        <label>Giacenza</label>
        <input type="number" name="giacenza" required/>
        <label>Prezzo</label>
        <input type="decimal" name="prezzo" required/>
        <button type="submit">Aggiungi Prodotto</button>
    </form>

@endsection
