@extends('app')

@section('content')
<div class="container-fluid">
    <h2>Tambah Pertanyaan untuk Kuis: {{ $quiz->title }}</h2>

    <form action="{{ route('questions.store', ['quiz_id' => $quiz->id]) }}" method="POST">

        @csrf
        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

        <div class="mb-3">
            <label for="question_text" class="form-label">Teks Pertanyaan</label>
            <input type="text" name="question_text" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilihan Jawaban</label>
            <input type="text" name="option_a" class="form-control mb-2" placeholder="Opsi A" required>
            <input type="text" name="option_b" class="form-control mb-2" placeholder="Opsi B" required>
            <input type="text" name="option_c" class="form-control mb-2" placeholder="Opsi C" required>
            <input type="text" name="option_d" class="form-control mb-2" placeholder="Opsi D" required>
        </div>

        <div class="mb-3">
            <label for="correct_option" class="form-label">Jawaban Benar</label>
            <select name="correct_option" class="form-select" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
