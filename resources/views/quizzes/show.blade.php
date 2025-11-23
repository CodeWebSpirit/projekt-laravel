@extends('layouts.app')

@section('title', $quiz['title'] ?? 'Quiz')

@section('content')
    <h1>{{ $quiz['title'] }}</h1>
    <p>{{ $quiz['description'] }}</p>

    <div>
        <h2>Pytania (Blade):</h2>
        <ol>
            @foreach($quiz['questions'] as $q)
                <li>
                    <strong>{{ $q['text'] }}</strong>
                    <ul>
                        @foreach($q['options'] as $opt)
                            <li>{{ $opt }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ol>
    </div>

    <hr>

    <div id="quiz-root" data-quiz='@json($quiz)'></div>
@endsection
