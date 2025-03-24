@extends('app')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4">
        <h3 class="fw-bold text-uppercase m-0">📚 Daftar Kuis untuk Sub CPMK: <strong>{{ $subCpmk->code }}</strong></h3>
    </div>
    <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('quizzes.create', $subCpmk->id) }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Kuis
        </a>
    </div>

    {{-- Alert untuk Notifikasi --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle"></i> {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($quizzes->count())
        <div class="row">
            @foreach ($quizzes as $quiz)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 rounded mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <a href="{{ route('questions.index', $quiz->id) }}">
                                    <i class="bi bi-patch-question-fill"></i> {{ $quiz->title }}
                                </a>
                            </h5>
                            <p class="text-muted mb-2">Total Pertanyaan: <span class="badge bg-secondary">{{ $quiz->questions->count() }}</span></p>

                            <div class="d-flex mt-3">
                                <a href="{{ route('quizzes.start', $quiz->id) }}" class="btn btn-outline-success btn-sm ms-2">
                                    <i class="bi bi-play-fill"></i> Start
                                </a>
                                <a href="{{ route('quiz.report', ['quiz_id' => $quiz->id]) }}" class="btn btn-outline-warning btn-sm ms-2">
                                    <i class="bi bi-bar-chart"></i> Report
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning text-center">
            <i class="bi bi-exclamation-circle"></i> Belum ada kuis untuk Sub CPMK ini.
        </div>
    @endif
</div>
@endsection
