@extends('layout')

@if(count($tasks)>0)
    <h2>Elenco tasks</h2><br>
    <ul>
        @foreach($tasks as $task)
            <li>
                <h3><a href="/tasks/{{$task->id}}">{{$task->title}}</a></h3>
            </li>
            <br>

        @endforeach
    </ul>
@else
    <h2>Al momento non sono disponibili task</h2>

@endif