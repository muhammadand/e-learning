@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Edit Mata Kuliah</h1>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="study_program_id" class="form-label">Program Studi</label>
            <select name="study_program_id" class="form-control" required>
                @foreach ($studyPrograms as $program)
                    <option value="{{ $program->id }}" {{ $course->study_program_id == $program->id ? 'selected' : '' }}>{{ $program->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Dosen Pengampu</label>
            <select name="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $course->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Kode Mata Kuliah</label>
            <input type="text" name="code" class="form-control" value="{{ $course->code }}" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Mata Kuliah</label>
            <input type="text" name="name" class="form-control" value="{{ $course->name }}" required>
        </div>

        <div class="mb-3">
            <label for="sks" class="form-label">SKS</label>
            <input type="number" name="sks" class="form-control" value="{{ $course->sks }}" required>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="number" name="semester" class="form-control" value="{{ $course->semester }}" required>
        </div>

        <div class="mb-3">
            <label for="tgl_penyusunan" class="form-label">Tanggal Penyusunan</label>
            <input type="date" name="tgl_penyusunan" class="form-control" value="{{ $course->tgl_penyusunan }}" required>
        </div>

        <div class="mb-3">
            <label for="short_description" class="form-label">Deskripsi Singkat</label>
            <textarea name="short_description" class="form-control">{{ $course->short_description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="learning_materials" class="form-label">Bahan Kajian</label>
            <textarea name="learning_materials" class="form-control">{{ $course->learning_materials }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection