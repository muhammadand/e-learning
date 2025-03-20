@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit CPL</h1>
    <a href="{{ route('cpls.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('cpls.update', $cpl->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="code" class="form-label">Kode CPL</label>
            <input type="text" name="code" class="form-control" value="{{ $cpl->code }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi CPL</label>
            <textarea name="description" class="form-control" required>{{ $cpl->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
