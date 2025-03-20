@extends('app')

@section('content')
<div class="container-fluid">
     <!-- Judul dengan desain menarik -->
     <div class="d-flex align-items-center mb-4">
        <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
        <h3 class="fw-bold text-uppercase m-0">kelola mata kuliah</h3>
    </div>
    <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">

<a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Tambah Mata Kuliah</a>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Simpan user ID dari dosen yang login -->
<table class="table table-bordered" id="coursesTable" data-user-id="{{ auth()->user()->id }}">
    <thead>
        <tr>
            <th>#</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>SKS</th>
            <th>Semester</th>
            <th>Dosen</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courses as $course)
            <tr class="course-row" data-course-owner="{{ $course->user_id }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $course->code }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->sks }}</td>
                <td>{{ $course->semester }}</td>
                <td>{{ $course->user->name }}</td>
                <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog"></i> Aksi
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('courses.show', $course->id) }}">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('courses.edit', $course->id) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('rps.show', $course->id) }}">
                                        <i class="fas fa-book"></i> Lihat RPS
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('feedback.index', $course->id) }}">
                                        <i class="fas fa-comments"></i> Tambah Feedback
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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
