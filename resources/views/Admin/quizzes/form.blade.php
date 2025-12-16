@extends('layouts.app')

@section('content')
<h1>{{ $quiz->exists ? 'Edytuj' : 'Dodaj' }} quiz</h1>

<form method="POST"
      action="{{ $quiz->exists ? route('admin.quizzes.update', $quiz) : route('admin.quizzes.store') }}">
    @csrf
    @if($quiz->exists)
        @method('PUT')
    @endif

    <div>
        <label>Tytuł:</label>
        <input type="text"
               name="title"
               value="{{ old('title', $quiz->title) }}"
               required>
    </div>

    <div>
        <label>Opis:</label>
        <textarea name="description" required>{{ old('description', $quiz->description) }}</textarea>
    </div>

    <hr>
    <h2>Pytania</h2>

    <div id="questions-container">
        @foreach(old('questions', $quiz->questions ?? []) as $i => $q)
            <div class="question-block" style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">

                @if(isset($q->id))
                    <input type="hidden" name="questions[{{ $i }}][id]" value="{{ $q->id }}">
                    <input type="hidden" name="questions[{{ $i }}][_delete]" value="0">
                @endif

                <label>Pytanie:</label>
                <input type="text"
                       name="questions[{{ $i }}][text]"
                       value="{{ $q['text'] ?? $q->text }}"
                       required>

                <label>Typ:</label>
                <select name="questions[{{ $i }}][type]">
                    <option value="single"
                        {{ ($q['type'] ?? $q->type) === 'single' ? 'selected' : '' }}>
                        Single
                    </option>
                    <option value="multiple"
                        {{ ($q['type'] ?? $q->type) === 'multiple' ? 'selected' : '' }}>
                        Multiple
                    </option>
                </select>

                <label>Opcje (JSON):</label>
                <textarea name="questions[{{ $i }}][options]" required>
{{ json_encode($q['options'] ?? $q->options, JSON_UNESCAPED_UNICODE) }}
                </textarea>

                <label>Prawidłowe odpowiedzi (JSON):</label>
                <textarea name="questions[{{ $i }}][correct_answers]" required>
{{ json_encode($q['correct_answers'] ?? $q->correct_answers, JSON_UNESCAPED_UNICODE) }}
                </textarea>

                @if(isset($q->id))
                    <button type="button"
                        onclick="
                            this.closest('.question-block')
                                .querySelector('input[name*=\'[_delete]\']')
                                .value = 1;
                            this.closest('.question-block').style.display='none';
                        ">
                        Usuń pytanie
                    </button>
                @else
                    <button type="button" class="remove-question">
                        Usuń pytanie
                    </button>
                @endif
            </div>
        @endforeach
    </div>

    <button type="button" id="add-question">Dodaj pytanie</button>

    <br><br>
    <button type="submit">Zapisz quiz</button>
</form>

<script>
let questionIndex = {{ count(old('questions', $quiz->questions ?? [])) }};

document.getElementById('add-question').addEventListener('click', function () {
    const container = document.getElementById('questions-container');

    const block = document.createElement('div');
    block.classList.add('question-block');
    block.style.border = '1px solid #ccc';
    block.style.padding = '10px';
    block.style.marginBottom = '10px';

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

        <label>Prawidłowe odpowiedzi (JSON):</label>
        <textarea name="questions[${questionIndex}][correct_answers]" required></textarea>

        <button type="button" class="remove-question">Usuń pytanie</button>
    `;

    container.appendChild(block);

    block.querySelector('.remove-question').addEventListener('click', function () {
        block.remove();
    });

    questionIndex++;
});
</script>
@endsection
