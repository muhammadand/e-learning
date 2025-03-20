@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail CPL</h1>
    <a href="{{ route('cpls.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $cpl->code }}</h3>
            <p><strong>Deskripsi CPL:</strong> {{ $cpl->description }}</p>
        </div>
    </div>
</div>
@endsection
