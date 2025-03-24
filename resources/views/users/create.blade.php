@extends('app')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center ">
        <iconify-icon icon="mdi:book-open" class="fs-5 text-primary me-2"></iconify-icon>
        <h3 class="fw-bold text-uppercase text-primary m-0">Tambah Pengguna</h3>
    </div>
    <hr class="mb-4 border-primary opacity-50" style="height: 2px; width: 180px;">
    
    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill px-4 mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="card shadow-sm border-0 rounded-4 p-4">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama</label>
                <input type="text" name="name" class="form-control rounded-pill px-3 @error('name') is-invalid @enderror" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control rounded-pill px-3 @error('email') is-invalid @enderror" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control rounded-pill px-3 @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role" class="form-label fw-semibold">Peran</label>
                <select name="role" class="form-select rounded-pill px-3 @error('role') is-invalid @enderror" required>
                    <option value="dosen">Dosen</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="akademik">Akademik</option>
                    <option value="program_studi">Program Studi</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="study_program_id" class="form-label fw-semibold">Program Studi</label>
                <select name="study_program_id" class="form-select rounded-pill px-3">
                    <option value="">Tidak Ada</option>
                    @foreach ($studyPrograms as $program)
                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-outline-primary rounded-pill px-4 mb-3">
                <i class="bi bi-save"></i> Simpan
            </button>
        </form>
    </div>
</div>
@endsection
