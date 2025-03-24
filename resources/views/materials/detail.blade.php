@extends('layout')

@section('content')
<div class="container">
    <h2 class="my-3">{{ $material->title }}</h2>
    <p class="text-muted">Diterbitkan pada: {{ $material->created_at->format('d M Y') }}</p>

    <div class="card p-3">
        <p>{{ $material->description }}</p>
        @if ($material->file_path)
            <a href="{{ asset('storage/' . $material->file_path) }}" class="btn btn-success mt-3" target="_blank">Download Materi</a>
        @endif
    </div>

    <form action="{{ route('materials.markAsDone', $material->id) }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-primary"
            {{ $isDone ? 'disabled' : '' }}>
            {{ $isDone ? 'Sudah Selesai' : 'Mark as Done' }}
        </button>
    </form>

    <a href="javascript:history.back()" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
