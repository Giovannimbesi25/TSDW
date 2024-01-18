@extends('layout')
@section('content')
        @if($book)
            <h2>Detail Page</h2>
            <form method="post" href="{{route('book.update', $book)}}">
                @csrf
                <input name="id" hidden required value="{{$book->id}}"/></h3>
                <h3>isbn <input name="isbn" required value="{{$book->isbn}}"/></h3>
                <h3>title <input name="title" required value="{{$book->title}}"/></h3>
                <h3>author <input name="author" required value="{{$book->author}}"/></h3>
                <h3>publisher <input name="publisher" required value="{{$book->publisher}}"/></h3>
                <h3>ranking <input name="ranking" required value="{{$book->ranking}}"/></h3>
                <h3>year <input name="year" required value="{{$book->year}}"/></h3>
                <h3>price <input name="price" required value="{{$book->price}}"/></h3>

                <button type="submit">Aggiorna</button>
                
            </form>
            <br><br>
            <form method="post" action="{{ route('book.delete', $book) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
            

        @else
            <h2>Non esiste un libro con questo ID</h2>
        @endif
@endsection

