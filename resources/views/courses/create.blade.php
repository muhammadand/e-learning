@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Tambah Mata Kuliah</h1>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="study_program_id" class="form-label">Program Studi</label>
            <select name="study_program_id" class="form-control" required>
                @foreach ($studyPrograms as $program)
                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Dosen Pengampu</label>
            <select name="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Kode Mata Kuliah</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Mata Kuliah</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="sks" class="form-label">SKS</label>
            <input type="number" name="sks" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="number" name="semester" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tgl_penyusunan" class="form-label">Tanggal Penyusunan</label>
            <input type="date" name="tgl_penyusunan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="short_description" class="form-label">Deskripsi Singkat</label>
            <textarea name="short_description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="learning_materials" class="form-label">Bahan Kajian</label>
            <textarea name="learning_materials" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
