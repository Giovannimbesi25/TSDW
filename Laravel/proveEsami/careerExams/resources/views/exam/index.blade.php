@extends('layout')
@section('content')
@if(count($exams)>0)
<h2>List Exams</h2>
<ul>
    @foreach($exams as $exam)
    <li>
        <h4>
            <a href="/exams/{{$exam->id}}">
                {{$exam->corso}}
            </a>
        </h4>
        </li>
    @endforeach
    </ul>
@else
    <h2>Non ci sono Esami</h2>
@endif
@endsection