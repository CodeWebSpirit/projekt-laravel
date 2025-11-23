@extends('layouts.app')

@section('title','Lista quizów')

@section('content')
    <h1>Lista quizów</h1>

    <ul>
        @forelse($quizzes as $q)
            <li>
                <a href="{{ route('quizzes.show', $q['id']) }}">{{ $q['title'] }}</a>
                <p>{{ $q['description'] }}</p>
            </li>
        @empty
            <li>Brak quizów.</li>
        @endforelse
    </ul>
@endsection
