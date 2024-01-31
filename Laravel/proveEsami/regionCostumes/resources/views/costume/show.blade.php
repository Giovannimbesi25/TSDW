@extends('layout')
@section('content')
    <h2>Update or Delete Costume</h2><br>

    <form method="post" action="/costumes/{{$costume->id}}">
        @csrf
        @method('PATCH')
        <label>Name</label>
        <input value="{{$costume->name}}" name="name" type="text" required/><br><br>
        <label>Job</label>
        <input value="{{$costume->job}}" name="job" type="text" required/><br><br>

        @if($costume->name === "Vulcan")
            <label>Img</label>
            <img src="{{$costume->img}}" alt="{{$costume->name}}" width="100">
        @else
            <label>Img</label>
            <input value="{{$costume->img}}" name="img" type="text" required/>
        @endif
        <br><br>
        <label>Prezzo</label>
        <input value="{{$costume->prezzo}}" name="prezzo" step="any" type="number" required/><br><br>

        <select name="costume_id">
            @foreach($regions as $region)
                <option {{$costume->region_id == $region->id ? 'selected' : ' '}} value="{{$costume->id}}">{{$costume->name}}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Modifica</button>
    </form>
    
    <form method="post" action="/costumes/{{$costume->id}}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
