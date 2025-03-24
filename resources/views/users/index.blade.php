@extends('app')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4">
        <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
        <h3 class="fw-bold text-uppercase m-0">Management Courses</h3>
    </div>
    <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">
        <a href="{{ route('users.create') }}" class="btn btn-outline-primary rounded-pill px-4">
            <i class="bi bi-plus-lg"></i> Tambah Pengguna
        </a>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-pill" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <table class="table table-borderless align-middle">
                <thead class="bg-light text-secondary rounded-3">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Peran</th>
                        <th>Program Studi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-bottom">
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td class="fw-semibold text-dark">{{ $user->name }}</td>
                            <td class="text-muted">{{ $user->email }}</td>
                            <td><span class="badge bg-secondary text-light rounded-pill px-3">{{ ucfirst($user->role) }}</span></td>
                            <td class="text-muted">{{ $user->studyProgram ? $user->studyProgram->name : '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-info rounded-pill px-3">
                                    show
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                    edit
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection