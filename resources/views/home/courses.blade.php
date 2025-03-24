
@extends('home')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="d-flex align-items-center mb-4">
            <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
            <h3 class="fw-bold text-uppercase m-0">Courses</h3>
        </div>
        <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">
      <div class="row g-4 justify-content-center">
        <div class="row g-3">
            @foreach ($courses as $course)
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0">
                        <img src="{{ asset('img/course.jpeg') }}" class="card-img-top" alt="Course Image">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold text-start">{{ $course->name }}</h5>
                            <p class="text-muted text-start mb-1">Instructor: {{ $course->user->name ?? 'Unknown' }}</p>

                            <!-- Progress Bar -->
                           

                            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary w-100">
                                Start Learning
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>       
      </div>
    </div>
  </div>
@endsection