@extends('layouts.app')

@section('content')
<h1>{{ $quiz->title }}</h1>
<p>{{ $quiz->description }}</p>

<form action="{{ route('quizzes.submit', $quiz) }}" method="POST">
    @csrf

    @foreach($quiz->questions as $question)
        <div style="margin-bottom:20px;">
            <p><strong>{{ $question->text }}</strong></p>

@php
    $oldAnswer = old('answers.' . $question->id);
@endphp

@foreach($question->options as $option)
    <div>
        <label>
            <input 
                type="{{ $question->type === 'multiple' ? 'checkbox' : 'radio' }}" 
                name="answers[{{ $question->id }}]{{ $question->type === 'multiple' ? '[]' : '' }}" 
                value="{{ $option }}"
                @if($question->type === 'multiple')
                    {{ (is_array($oldAnswer) && in_array($option, $oldAnswer)) ? 'checked' : '' }}
                @else
                    {{ ($oldAnswer === $option) ? 'checked' : '' }}
                @endif
            >
            {{ $option }}
        </label>
    </div>
@endforeach

            @error('answers.' . $question->id)
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>
    @endforeach

    <button type="submit">Zakończ quiz</button>
</form>
@endsection
