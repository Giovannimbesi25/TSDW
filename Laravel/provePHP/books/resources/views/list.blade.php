@extends('layout')
@section('content')
    @if(count($books) > 0)
        <h2>Lista libri</h2>
        <ul>
            @foreach($books as $book)
                <li>
                    <form method="get" action="{{route('book.detail', $book->id)}}">
                        <button type="submit">{{$book->isbn}}</button>
                    </form>
                    <p>{{$book->title}}</p>
                    <p>{{$book->author}}</p>
                    <p>{{$book->publisher}}</p>
                    <p>{{$book->ranking}}</p>
                    <p>{{$book->year}}</p>
                    <p>{{$book->price}}</p>
                </li>
                <br>
            @endforeach
        </ul>
    @else
        <h2>La libreria è vuota</h2>
    @endif
    <br>
    <h3>Inserisci un nuovo libro</h3>
    <form method="post" action="{{route('book.aggiungi')}}">
        @csrf
        <h4>isbn <input required type="text" name="isbn"></h4>
        <h4>title <input required type="text" name="title"></h4>
        <h4>author <input required type="text" name="author"></h4>
        <h4>publisher <input required type="text" name="publisher"></h4>
        <h4>ranking <input required type="number" name="ranking"></h4>
        <h4>year <input required type="number" name="year"></h4>
        <h4>price <input required type="number" name="price"></h4>
        <button type="submit">Aggiungi</button>
    </form>
@endsection

