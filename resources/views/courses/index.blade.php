@extends('app')

@section('content')
<div class="container-fluid">
    <!-- Judul dengan desain menarik -->
    <div class="d-flex align-items-center mb-4">
        <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
        <h3 class="fw-bold text-uppercase m-0">Management Courses</h3>
    </div>
    <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">
    
    <!-- Tombol dengan desain lebih elegan -->
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('courses.create') }}" class="btn btn-primary shadow-sm fw-semibold px-4 py-2 rounded-pill">
            <i class="fas fa-plus me-1"></i> Create Courses
        </a>
        <a href="{{ route('course_cpl.index') }}" class="btn btn-secondary shadow-sm fw-semibold px-4 py-2 rounded-pill">
            <i class="fas fa-link me-1"></i> Courses to CPL
        </a>
        <a href="{{ route('cpls.index') }}" class="btn btn-success shadow-sm fw-semibold px-4 py-2 rounded-pill">
            <i class="fas fa-book me-1"></i> CPL
        </a>
        <a href="{{ route('sub_cpmks.index') }}" class="btn btn-warning shadow-sm fw-semibold px-4 py-2 rounded-pill">
            <i class="fas fa-list me-1"></i> Sub CPMK
        </a>
        <a href="{{route('materials.index')}}" class="btn btn-dark shadow-sm fw-semibold px-4 py-2 rounded-pill">
            <i class="fas fa-list me-1"></i> Material
        </a>
        
    </div>
    
    <style>
        .btn {
            transition: all 0.3s ease-in-out;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
    

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered mt-4" id="coursesTable" data-user-id="{{ auth()->user()->id }}">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Dosen</th>
                <th>Aksi</th>
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
                            <button class="btn btn-light btn-sm dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog"></i> Aksi
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('courses.show', $course->id) }}"><i class="fas fa-eye"></i> Lihat</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.edit', $course->id) }}"><i class="fas fa-edit"></i> Edit</a></li>
                                <li><a class="dropdown-item" href="{{ route('rps.show', $course->id) }}"><i class="fas fa-book"></i> Lihat RPS</a></li>
                                <li><a class="dropdown-item" href="{{ route('feedback.index', $course->id) }}"><i class="fas fa-comments"></i> Tambah Feedback</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.report', $course->id) }}"><i class="fas fa-chart-line"></i> Laporan</a></li>
                                <li>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
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
            row.style.display = "none";
        }
    });
});
</script>
@endsection