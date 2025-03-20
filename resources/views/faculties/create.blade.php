@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Tambah Fakultas</h1>
    <a href="{{ route('faculties.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('faculties.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Fakultas</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
