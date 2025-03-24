@extends('app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-uppercase m-0 text-primary">
            <i class="bi bi-bar-chart-line-fill"></i> Laporan Kuis: {{ $quiz->title }}
        </h3>
    </div>

    <hr class="mb-4 border-3 border-primary opacity-75" style="width: 250px;">

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle shadow-sm">
            <thead class="table-primary text-center">
                <tr>
                    <th style="width: 30%;">Nama Mahasiswa</th>
                    <th style="width: 25%;">Prodi</th>
                    <th style="width: 15%;">Skor</th>
                    <th style="width: 20%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quiz->attempts->groupBy('user_id') as $user_id => $attempts)
                    @php
                        $firstAttempt = $attempts->first(); // Ambil attempt pertama
                        $averageScore = round($attempts->avg('score'), 2); // Ambil rata-rata skor
                    @endphp
                    <tr class="text-center">
                        <td class="fw-semibold">{{ $firstAttempt->user->name }}</td>
                        <td>{{ $firstAttempt->user->studyProgram->name ?? 'Tidak Diketahui' }}</td>
                        <td class="fw-bold text-success">{{ $averageScore }}</td>
                        <td>
                            <a href="{{ route('quiz.detail', ['user_id' => $user_id, 'quiz_id' => $quiz->id]) }}" 
                               class="btn btn-outline-info btn-sm px-3 shadow-sm">
                                <i class="bi bi-eye-fill"></i> Detail Jawaban
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
