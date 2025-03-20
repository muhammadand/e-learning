@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Edit CPMK</h1>
    <a href="{{ route('cpmks.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('cpmks.update', $cpmk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="course_id" class="form-label">Mata Kuliah</label>
            <select name="course_id" class="form-control" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $cpmk->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Kode CPMK</label>
            <input type="text" name="code" class="form-control" value="{{ $cpmk->code }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi CPMK</label>
            <textarea name="description" class="form-control" required>{{ $cpmk->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
