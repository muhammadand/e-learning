@extends('app')

@section('content')
<div class="container">
    <h1>Detail Pengguna</h1>
    <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $user->name }}</h3>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Peran:</strong> {{ ucfirst($user->role) }}</p>
            <p><strong>Program Studi:</strong> {{ $user->studyProgram ? $user->studyProgram->name : '-' }}</p>
        </div>
    </div>
</div>
@endsection
