@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Relasi Course → CPL</h1>
    <a href="{{ route('course_cpl.create') }}" class="btn btn-primary mb-3">Tambah Relasi</a>

    @if ($courses->isEmpty())
        <p class="text-muted">Belum ada data Course dan CPL.</p>
    @else
        <div class="accordion" id="courseAccordion">
            @foreach ($courses as $course)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingCourse{{ $course->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCourse{{ $course->id }}" aria-expanded="true" aria-controls="collapseCourse{{ $course->id }}">
                            📚 {{ $course->name }}
                        </button>
                    </h2>
                    <div id="collapseCourse{{ $course->id }}" class="accordion-collapse collapse" aria-labelledby="headingCourse{{ $course->id }}" data-bs-parent="#courseAccordion">
                        <div class="accordion-body">
                            @if ($course->cpls->isEmpty())
                                <p class="text-muted">Tidak ada CPL terkait untuk mata kuliah ini.</p>
                            @else
                                <ul class="list-group">
                                    @foreach ($course->cpls as $cpl)
                                        <li class="list-group-item">
                                            🔹 <strong>{{ $cpl->code }}</strong> - {{ $cpl->description }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
