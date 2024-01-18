@extends('layout')

@if(count($projects)>0)
    <h2>Elenco progetti</h2><br>
    <ul>
        @foreach($projects as $project)
            <li>
                <h3><a href="/projects/{{$project->id}}">{{$project->title}}</a></h3>
            </li>
            <br>

        @endforeach
    </ul>
@else
    <h2>Al momento non sono disponibili progetti</h2>

@endif