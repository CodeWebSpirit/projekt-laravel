@extends('layouts.app')

@section('content')
<h1>Wynik quizu: {{ $quiz->title }}</h1>
<p>Twój wynik: {{ $score }} / {{ $quiz->questions->count() }}</p>

<a href="{{ route('quizzes.show', $quiz) }}">Spróbuj ponownie</a>
@endsection
