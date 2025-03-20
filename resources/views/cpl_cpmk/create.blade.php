@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Hubungkan CPL ke CPMK</h1>
    <a href="{{ route('cpl_cpmk.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('cpl_cpmk.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Pilih Course</label>
            <select name="course_id" class="form-control" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Pilih CPL</label>
            <select name="cpl_id" class="form-control" required>
                @foreach ($cpls as $cpl)
                    <option value="{{ $cpl->id }}">{{ $cpl->code }} - {{ $cpl->description }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih CPMK</label>
            <select name="cpmk_ids[]" class="form-control" multiple required>
                @foreach ($cpmks as $cpmk)
                    <option value="{{ $cpmk->id }}">{{ $cpmk->code }} - {{ $cpmk->description }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
