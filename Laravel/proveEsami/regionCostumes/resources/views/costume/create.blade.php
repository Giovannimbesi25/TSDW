@extends('layout')
@section('content')
    <h2>Create New Costume</h2><br>

    <form method="post" action="/costumes">
        @csrf
        <label>Name</label>
        <input name="name" type="text" required/><br><br>
        <label>Job</label>
        <input name="job" type="text" required/><br><br>
        <label>Img</label>
        <input name="img" type="text" required/><br><br>
        <label>Prezzo</label>
        <input name="prezzo" step="any" type="number" required/><br><br>

        <select name="region_id">
            @foreach($regions as $region)
                <option value="{{$region->id}}">{{$region->name}}</option>
            @endforeach
        </select>
        <input type="submit" value="Aggiungi" />
    </form>
@endsection

