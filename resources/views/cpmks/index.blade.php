@extends('app')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4">
        <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
        <h3 class="fw-bold text-uppercase m-0">Daftar CPMK (Capaian Pembelajaran Mata Kuliah)</h3>
    </div>
    <a href="{{ route('cpmks.create') }}" class="btn btn-primary mb-3">Tambah CPMK</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered" id="coursesTable" data-user-id="{{ auth()->user()->id }}">
        <thead>
              <tr>
                <th>#</th>
                <th>Kode CPMK</th>
                <th>Deskripsi</th>
                <th>Code CPL</th>
                <th>Mata Kuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cpmks as $cpmk)
            <tr class="course-row" data-course-owner="{{ $cpmk->course->user_id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cpmk->code }}</td>
                    <td>{{ $cpmk->description }}</td>
                    <td>{{ $cpmk->cpl->code }}</td>
                    <td>{{ $cpmk->course->name }}</td>
                    
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog"></i> Aksi
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('cpmks.show', $cpmk->id) }}">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('cpmks.edit', $cpmk->id) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('quizzes.index', ['cpmk_id' => $cpmk->id]) }}">
                                        <i class="fas fa-book"></i> Quizzes
                                    </a>
                                </li>

                                <li>
                                    <form action="{{ route('cpmks.destroy', $cpmk->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </li>
                            </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let loggedInUserId = document.getElementById('coursesTable').dataset.userId;
        
        document.querySelectorAll('.course-row').forEach(row => {
            let courseOwnerId = row.dataset.courseOwner;
            if (loggedInUserId !== courseOwnerId) {
                row.style.display = "none"; // Sembunyikan course jika bukan milik user
            }
        });
    });
    </script>
@endsection
