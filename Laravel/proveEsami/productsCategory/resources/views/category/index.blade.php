@extends('layout')
@section('content')


@if(count($categories)>0)
    <h2>Lista Categorie</h2><br>
    <ul>
    @foreach($categories as $category)
        <li>
            <h3><a href="/categories/{{$category->id}}">{{$category->nome}}</a></h3>
        </li>
    @endforeach
    </ul>
@else
    <h2>Non ci sono categorie al momento</h2>
@endif
    <br><br>
@endsection