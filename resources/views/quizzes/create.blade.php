@extends('app')

@section('content')
<div class="container-fluid">
    <h2>Tambah Kuis untuk CPMK: {{ $cpmk->name }}</h2>

    <form action="{{ route('quizzes.store', ['cpmk_id' => $cpmk->id]) }}" method="POST">

        @csrf
        <input type="hidden" name="cpmk_id" value="{{ $cpmk->id }}">

        <div class="mb-3">
            <label for="title" class="form-label">Judul Kuis</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
