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
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    
        @if($courses->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> You are not enrolled in any courses yet.
            </div>
        @else
            <div class="row g-3">
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm border-0">
                            <img src="{{ asset('img/course.jpeg') }}" class="card-img-top" alt="Course Image">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold text-start">{{ $course->name }}</h5>
                                <p class="text-muted text-start mb-1">Instructor: {{ $course->user->name ?? 'Unknown' }}</p>

                                <!-- Progress Bar -->
                                <p class="text-muted mb-1">{{ number_format($course->progress, 0) }}% Complete</p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-success" role="progressbar" 
                                        style="width: {{ number_format($course->progress, 0) }}%;" 
                                        aria-valuenow="{{ number_format($course->progress, 0) }}" 
                                        aria-valuemin="0" aria-valuemax="100">
                                        {{ number_format($course->progress, 0) }}%
                                    </div>
                                </div>

                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary w-100">
                                    Start Learning
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection