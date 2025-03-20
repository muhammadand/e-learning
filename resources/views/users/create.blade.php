@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Tambah Pengguna</h1>
    <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Peran</label>
            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                <option value="dosen">Dosen</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="akademik">Akademik</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="study_program_id" class="form-label">Program Studi</label>
            <select name="study_program_id" class="form-control">
                <option value="">Tidak Ada</option>
                @foreach ($studyPrograms as $program)
                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
