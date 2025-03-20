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
                    <option value="{{ $program->id }}" {{ $course->study_program_id == $program->id ? 'selected' : '' }}>
                        {{ $program->name }}
                    </option>
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

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
