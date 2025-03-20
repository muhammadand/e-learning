@extends('app')

@section('content')
<div class="container-fluid">
    <h2>Pertanyaan untuk Kuis: {{ $quiz->title }}</h2>
    <a href="{{ route('questions.create', $quiz->id) }}" class="btn btn-primary mb-3">Tambah Pertanyaan</a>

    @if($questions->count())
        <ul class="list-group">
            @foreach ($questions as $question)
                <li class="list-group-item">
                    <strong>{{ $question->question_text }}</strong>
                    <br>
                    A) {{ $question->option_a }} <br>
                    B) {{ $question->option_b }} <br>
                    C) {{ $question->option_c }} <br>
                    D) {{ $question->option_d }} <br>
                    <small>Jawaban Benar: {{ $question->correct_option }}</small>
                </li>
            @endforeach
        </ul>
    @else
        <p>Belum ada pertanyaan untuk kuis ini.</p>
    @endif
</div>
@endsection
