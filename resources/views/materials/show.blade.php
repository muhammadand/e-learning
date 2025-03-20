@extends('app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-3">{{ $material->title }}</h1>

    <div class="card p-3 mb-3">
        <p><strong>Deskripsi:</strong> {{ $material->description }}</p>
        <p><strong>Course:</strong> {{ $material->course->name }}</p>
        <p><strong>CPMK:</strong> {{ $material->cpmk->code }}</p>

        @if($material->file_path)
            <p><strong>File:</strong> 
                <a href="{{ asset('storage/' . $material->file_path) }}" class="btn btn-sm btn-success" target="_blank">
                    Download File
                </a>
            </p>
        @endif
    </div>

    <a href="{{ route('materials.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning">Edit</a>

    <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" onclick="return confirm('Hapus materi ini?')">Hapus</button>
    </form>
</div>
@endsection
