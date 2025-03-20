@extends('app')

@section('content')
<div class="container-fluid">
    <h2 class="text-center mb-4">📚 Daftar Kuis untuk CPMK: <strong>{{ $cpmk->name }}</strong></h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('quizzes.create', $cpmk->id) }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Kuis
        </a>
    </div>

    @if($quizzes->count())
        <div class="row">
            @foreach ($quizzes as $quiz)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 rounded mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <i class="bi bi-patch-question-fill"></i> {{ $quiz->title }}
                            </h5>
                            <p class="text-muted mb-2">Total Pertanyaan: <span class="badge bg-secondary">{{ $quiz->questions->count() }}</span></p>

                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('questions.index', $quiz->id) }}" class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-list-task"></i> Lihat Pertanyaan
                                </a>
                                <a href="{{ route('quizzes.start', $quiz->id) }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-play-fill"></i> Mulai Kuis
                                </a>
                                <a href="{{ route('quiz.report', ['quiz_id' => $quiz->id]) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-bar-chart"></i> Laporan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning text-center">
            <i class="bi bi-exclamation-circle"></i> Belum ada kuis untuk CPMK ini.
        </div>
    @endif
</div>
@endsection
