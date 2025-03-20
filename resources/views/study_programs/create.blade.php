@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Tambah Program Studi</h1>
    <a href="{{ route('study_programs.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('study_programs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="faculty_id" class="form-label">Fakultas</label>
            <select name="faculty_id" class="form-control @error('faculty_id') is-invalid @enderror" required>
                <option value="">Pilih Fakultas</option>
                @foreach ($faculties as $faculty)
                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                @endforeach
            </select>
            @error('faculty_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Program Studi</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
