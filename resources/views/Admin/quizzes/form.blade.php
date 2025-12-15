@extends('layouts.app')

@section('content')
<h1>{{ $quiz->exists ? 'Edytuj' : 'Dodaj' }} quiz</h1>

<form method="POST" action="{{ $quiz->exists ? route('admin.quizzes.update', $quiz) : route('admin.quizzes.store') }}">
    @csrf
    @if($quiz->exists)
        @method('PUT')
    @endif

    <div>
        <label>Tytuł:</label>
        <input type="text" name="title" value="{{ old('title', $quiz->title) }}" required>
    </div>

    <div>
        <label>Opis:</label>
        <textarea name="description" required>{{ old('description', $quiz->description) }}</textarea>
    </div>

    <hr>
    <h2>Pytania</h2>

    <div id="questions-container">
        @foreach(old('questions', $quiz->questions ?? []) as $i => $q)
            <div class="question-block">
                @if(isset($q->id) || isset($q['id']))
                <input type="hidden" name="questions[{{ $i }}][id]" value="{{ $q['id'] ?? $q->id }}">
                @endif
                <label>Pytanie:</label>
                <input type="text" name="questions[{{ $i }}][text]" value="{{ $q['text'] ?? $q->text }}" required>

                <label>Typ:</label>
                <select name="questions[{{ $i }}][type]">
                    <option value="single" {{ ($q['type'] ?? $q->type) === 'single' ? 'selected' : '' }}>Single</option>
                    <option value="multiple" {{ ($q['type'] ?? $q->type) === 'multiple' ? 'selected' : '' }}>Multiple</option>
                </select>

                <label>Opcje (JSON):</label>
                <textarea name="questions[{{ $i }}][options]" required>{{ json_encode($q['options'] ?? $q->options) }}</textarea>

                <label>Prawidłowa odpowiedź (JSON):</label>
                <textarea name="questions[{{ $i }}][correct_answers]" required>{{ json_encode($q['correct_answers'] ?? $q->correct_answers) }}</textarea>

                @if(isset($q->id))
                <form method="POST" action="{{ route('admin.questions.destroy', $q) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Na pewno chcesz usunąć to pytanie?')">Usuń pytanie</button>
                </form>
                @else
                <button type="button" class="remove-question">Usuń pytanie</button>
                @endif
                <hr>
            </div>
        @endforeach
    </div>

    <button type="button" id="add-question">Dodaj pytanie</button>
    <br><br>
    <button type="submit">Zapisz quiz</button>
</form>

<script>
let questionIndex = {{ count(old('questions', $quiz->questions ?? [])) }};

document.getElementById('add-question').addEventListener('click', function() {
    const container = document.getElementById('questions-container');

    const block = document.createElement('div');
    block.classList.add('question-block');
    block.innerHTML = `
        <label>Pytanie:</label>
        <input type="text" name="questions[${questionIndex}][text]" required>

        <label>Typ:</label>
        <select name="questions[${questionIndex}][type]">
            <option value="single">Single</option>
            <option value="multiple">Multiple</option>
        </select>

        <label>Opcje (JSON):</label>
        <textarea name="questions[${questionIndex}][options]" required></textarea>

        <label>Prawidłowa odpowiedź (JSON):</label>
        <textarea name="questions[${questionIndex}][correct_answers]" required></textarea>

        <button type="button" class="remove-question">Usuń pytanie</button>
        <hr>
    `;
    container.appendChild(block);

    block.querySelector('.remove-question').addEventListener('click', function() {
        block.remove();
    });

    questionIndex++;
});

document.querySelectorAll('.remove-question').forEach(btn => {
    btn.addEventListener('click', function() {
        btn.closest('.question-block').remove();
    });
});
</script>
@endsection
