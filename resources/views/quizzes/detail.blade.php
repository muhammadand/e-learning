@extends('app')

@section('content')
<div class="container-fluid">
    <h2>Detail Jawaban: {{ $attempts->first()->user->name }} ({{ $attempts->first()->user->studyProgram->name ?? 'Tidak Diketahui' }})</h2>

    @php
        $total_questions = count($questions); // Total jumlah soal
        $correct_answers = 0; // Hitung jumlah jawaban benar
    @endphp

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pertanyaan</th>
                <th>Jawaban Mahasiswa</th>
                <th>Benar/Salah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
                @php
                    // Cari jawaban mahasiswa berdasarkan question_id
                    $answer = $attempts->flatMap->answers->where('question_id', $question->id)->first();
                    $is_correct = $answer->is_correct ?? false;

                    // Tambahkan ke jawaban benar jika is_correct == true
                    if ($is_correct) {
                        $correct_answers++;
                    }
                @endphp
                <tr>
                    <td>{{ $question->question_text }}</td>
                    <td>{{ $answer->selected_option ?? '-' }}</td>
                    <td>
                        @if($is_correct)
                            ✅ Benar
                        @else
                            ❌ Salah
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @php
        // Hitung skor dalam bentuk persentase
        $final_score = $total_questions > 0 ? ($correct_answers / $total_questions) * 100 : 0;
    @endphp

    <h3>Skor Akhir: {{ number_format($final_score, 2) }}%</h3>
</div>
@endsection
