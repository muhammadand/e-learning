@extends('app')

@section('content')
<div class="container-fluid">
   
   
<div class="container mt-4">
    <!-- Judul dengan desain menarik -->
    <div class="d-flex align-items-center mb-4">
        <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
        <h3 class="fw-bold text-uppercase m-0">Enrolled Courses</h3>
    </div>
    <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">

    <div class="row g-3">
        @foreach ($courses as $index => $course)
            @if ($index % 3 == 0) <!-- Setiap 3 card, buat baris baru -->
                <div class="w-100"></div>
            @endif
            <div class="col-md-4 col-sm-6"> <!-- 3 card per baris -->
                <div class="card shadow-sm border-0" style="width: 16rem;">
                    <img src="{{ asset('img/course.jpeg') }}" class="card-img-top" alt="Course Image">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <h5 class="card-title fw-bold text-start">{{ $course->name }}</h5>
                        <p class="text-muted mb-1 text-start">{{ $course->user->name }}</p>

                        <p class="text-muted mb-1">{{ number_format($course->progress, 0) }}% Complete</p>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-success" role="progressbar" 
                                style="width: {{ $course->progress }}%;" 
                                aria-valuenow="{{ $course->progress }}" 
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary w-100">Start Learning</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>




@endsection
