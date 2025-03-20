@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Tambah Konten - {{ $course->name }}</h1>
    <a href="{{ route('course_contents.index', $course->id) }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('course_contents.store', $course->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Konten</label>
            <input type="text" name="name" class="form-control" required placeholder="Masukkan nama konten">
        </div>

        <button type="submit" class="btn btn-success">Simpan Konten</button>
    </form>
</div>
@endsection
