@extends('layouts.app')

@section('content')
<h1>Panel administratora Quizy</h1>

<a href="{{ route('admin.quizzes.create') }}">Dodaj quiz</a>

<ul>
@foreach($quizzes as $quiz)
    <li>
        {{ $quiz->title }}

        <form action="{{ route('admin.quizzes.edit', $quiz) }}"method="POST" style="display:inline;">
            @csrf
            @method('GET')
        <button type="submit">Edytuj</button>
    </form>

        <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Usuń</button>
        </form>
    </li>
@endforeach
</ul>
@endsection
