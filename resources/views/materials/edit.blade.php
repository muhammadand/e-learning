@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Edit Materi</h1>
    <form action="{{ route('materials.update', $material->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul Materi</label>
            <input type="text" name="title" class="form-control" value="{{ $material->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ $material->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="course_id" class="form-label">Mata Kuliah</label>
            <select name="course_id" class="form-control">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $material->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="cpmk_id" class="form-label">CPMK</label>
            <select name="cpmk_id" class="form-control">
                @foreach ($cpmks as $cpmk)
                    <option value="{{ $cpmk->id }}" {{ $material->cpmk_id == $cpmk->id ? 'selected' : '' }}>
                        {{ $cpmk->code }} - {{ $cpmk->description }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
