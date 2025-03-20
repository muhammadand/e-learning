@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Detail CPMK</h1>
    <a href="{{ route('cpmks.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $cpmk->code }}</h3>
            <p><strong>Deskripsi CPMK:</strong> {{ $cpmk->description }}</p>
            <p><strong>Mata Kuliah:</strong> {{ $cpmk->course->name }}</p>
        </div>
    </div>
</div>
@endsection
