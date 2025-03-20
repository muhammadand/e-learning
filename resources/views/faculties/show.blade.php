@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Detail Fakultas</h1>
    <a href="{{ route('faculties.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $faculty->name }}</h3>
            <p><strong>Dibuat:</strong> {{ $faculty->created_at->format('d M Y') }}</p>
            <p><strong>Diupdate:</strong> {{ $faculty->updated_at->format('d M Y') }}</p>
        </div>
    </div>
</div>
@endsection
