@extends('app')

@section('content')
<div class="container-fluid">
   <!-- Judul dengan desain menarik -->
   <div class="d-flex align-items-center mb-4">
        <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
        <h3 class="fw-bold text-uppercase m-0">Dashboard</h3>
    </div>
    <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">

    @php
        $user = auth()->user();
    @endphp

    <div class="alert alert-primary" role="alert">
        <h4 class="alert-heading">Selamat Datang, {{ $user->name }}!</h4>
        <p>Anda login sebagai <strong>{{ $user->role }}</strong></p>
    </div>

    <div class="row g-4">
        <!-- Total Courses -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0">
                <div class="card-body d-flex align-items-center">
                    <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-3"></iconify-icon>
                    <div>
                        <p class="mb-1 text-muted">Total Courses</p>
                        <h5 class="mb-0">{{ $totalCourses }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- In Progress Courses -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0">
                <div class="card-body d-flex align-items-center">
                    <iconify-icon icon="mdi:progress-clock" class="fs-6 text-success me-3"></iconify-icon>
                    <div>
                        <p class="mb-1 text-muted">In Progress Courses</p>
                        <h5 class="mb-0">{{ $inProgressCourses }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Courses -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0">
                <div class="card-body d-flex align-items-center">
                    <iconify-icon icon="mdi:check-circle" class="fs-6 text-warning me-3"></iconify-icon>
                    <div>
                        <p class="mb-1 text-muted">Completed Courses</p>
                        <h5 class="mb-0">{{ $completedCourses }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses in Progress -->
    <div class="row g-4 mt-4">
        <div class="col-12">
            <h5 class="mb-3">In Progress Courses</h5>
        </div>

        @forelse ($courses->where('progress', '>', 0) as $course)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow border-0">
                    <img src="{{ asset('img/course.jpeg') }}" class="card-img-top" alt="Course Image">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $course->name }}</h5>
                        <p class="text-muted mb-1">Instructor: {{ $course->user->name }}</p>

                        {{-- Pastikan progress ditampilkan sebagai 100% jika semua materi selesai --}}
                        <p class="text-muted mb-1">
                            {{ $course->progress == 100 ? 'Completed' : number_format($course->progress, 0) . '% Complete' }}
                        </p>

                        {{-- Progress Bar --}}
                        <div class="progress mb-3">
                            <div class="progress-bar 
                                {{ $course->progress == 100 ? 'bg-success' : 'bg-primary' }}" 
                                role="progressbar" 
                                style="width: {{ $course->progress }}%;" 
                                aria-valuenow="{{ $course->progress }}" 
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        {{-- Tampilkan teks berbeda jika course sudah 100% --}}
                        <div class="d-flex gap-2 mt-4">
                            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary w-100">
                                {{ $course->progress == 100 ? 'Review' : 'Continue Learning' }}
                            </a>
                        
                            @if ($course->progress == 100)
                                <a href="{{ route('feedback.index', $course->id) }}" class="btn btn-warning w-100">Masukan</a>
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">Belum ada kursus yang sedang berlangsung.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
