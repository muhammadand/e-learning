@extends('app')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4">
        <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
        <h3 class="fw-bold text-uppercase m-0">Pertanyaan untuk Kuis: {{ $quiz->title }}</h3>
    </div>
    <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">
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
    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('quizzes.index', ['sub_cpmk_id' => $quiz->sub_cpmk_id]) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>
@endsection
