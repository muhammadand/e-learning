@extends('app')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h3 class="fw-bold text-uppercase m-0">Hubungkan Course ke CPL</h3>
        <a href="{{ route('course_cpl.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">

    <form action="{{ route('course_cpl.store') }}" method="POST" class="p-4 border rounded shadow-sm bg-white">
        @csrf

        {{-- Pilih Course --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Pilih Course</label>
            <select name="course_id" class="form-select" required>
                <option value="" disabled selected>-- Pilih Course --</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Pilih CPL (Checkbox) --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Pilih CPL</label>
            <div class="border rounded p-3">
                @foreach ($cpls as $cpl)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="cpl_ids[]" value="{{ $cpl->id }}" id="cpl_{{ $cpl->id }}">
                        <label class="form-check-label" for="cpl_{{ $cpl->id }}">
                            <strong>{{ $cpl->code }}</strong> - {{ $cpl->description }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Simpan
        </button>
    </form>
</div>
@endsection
