@extends('app')

@section('content')
<div class="container-fluid">
    <h2>Laporan Kuis: {{ $quiz->title }}</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Prodi</th>
                <th>Skor</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quiz->attempts->groupBy('user_id') as $user_id => $attempts)
                @php
                    $firstAttempt = $attempts->first(); // Ambil attempt pertama
                    $averageScore = round($attempts->avg('score'), 2); // Ambil rata-rata skor
                @endphp
                <tr>
                    <td>{{ $firstAttempt->user->name }}</td>
                    <td>{{ $firstAttempt->user->studyProgram->name ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $averageScore }}</td>
                    <td>
                        <a href="{{ route('quiz.detail', ['user_id' => $user_id, 'quiz_id' => $quiz->id]) }}" class="btn btn-info btn-sm">Detail Jawaban</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
