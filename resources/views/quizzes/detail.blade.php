@extends('app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-uppercase text-primary">
            <i class="bi bi-card-checklist"></i> Detail Jawaban
        </h3>
    </div>

    <h4 class="mb-3">
        <span class="text-dark fw-semibold">{{ $attempts->first()->user->name }}</span> 
        <small class="text-muted">({{ $attempts->first()->user->studyProgram->name ?? 'Tidak Diketahui' }})</small>
    </h4>

    <hr class="mb-4 border-3 border-primary opacity-75" style="width: 250px;">

    @php
        $total_questions = count($questions); // Total jumlah soal
        $correct_answers = 0; // Hitung jumlah jawaban benar
    @endphp

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle shadow-sm">
            <thead class="table-primary text-center">
                <tr>
                    <th style="width: 50%;">Pertanyaan</th>
                    <th style="width: 30%;">Jawaban Mahasiswa</th>
                    <th style="width: 20%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                    @php
                        $answer = $attempts->flatMap->answers->where('question_id', $question->id)->first();
                        $is_correct = $answer->is_correct ?? false;

                        if ($is_correct) {
                            $correct_answers++;
                        }
                    @endphp
                    <tr>
                        <td>{{ $question->question_text }}</td>
                        <td class="fw-semibold text-center">{{ $answer->selected_option ?? '-' }}</td>
                        <td class="text-center">
                            @if($is_correct)
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle-fill"></i> Benar
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle-fill"></i> Salah
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @php
        $final_score = $total_questions > 0 ? ($correct_answers / $total_questions) * 100 : 0;
    @endphp

<div class=" p-3 border rounded text-end bg-white ">
    <h5 class="fw-semibold mb-1">Skor Akhir</h5>
    <p class="fs-5 text-dark fw-bold">{{ number_format($final_score, 2) }}%</p>
</div>


</div>
@endsection
