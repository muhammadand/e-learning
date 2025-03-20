@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Detail Program Studi</h1>
    <a href="{{ route('study_programs.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $studyProgram->name }}</h3>
            <p><strong>Fakultas:</strong> {{ $studyProgram->faculty->name }}</p>
            <p><strong>Dibuat:</strong> {{ $studyProgram->created_at->format('d M Y') }}</p>
            <p><strong>Diupdate:</strong> {{ $studyProgram->updated_at->format('d M Y') }}</p>
        </div>
    </div>
</div>
@endsection
