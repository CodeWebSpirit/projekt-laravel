@extends('layouts.app')

@section('content')
<h1>Lista dostępnych quizów</h1>

@if($quizzes->isEmpty())
    <p>Brak dostępnych quizów.</p>
@else
    <ul>
        @foreach($quizzes as $quiz)
            <li>
                <a href="{{ route('quizzes.show', $quiz) }}">{{ $quiz->title }}</a>
                <p>{{ $quiz->description }}</p>
            </li>
        @endforeach
    </ul>
@endif
@endsection
