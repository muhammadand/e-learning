@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Tambah CPL</h1>
    <a href="{{ route('cpls.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('cpls.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="code" class="form-label">Kode CPL</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi CPL</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
