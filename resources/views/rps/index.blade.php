@extends('app')

@section('content')
<div class="container-fluid">
    <h1>📜 Rencana Pembelajaran Semester (RPS)</h1>

    @if ($courses->isEmpty())
        <p class="text-muted">Belum ada mata kuliah yang dibuat.</p>
    @else
        <div class="accordion" id="courseAccordion">
            @foreach ($courses as $course)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingCourse{{ $course->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCourse{{ $course->id }}" aria-expanded="true" aria-controls="collapseCourse{{ $course->id }}">
                            📚 {{ $course->name }} ({{ $course->code }})
                        </button>
                    </h2>
                    <div id="collapseCourse{{ $course->id }}" class="accordion-collapse collapse" aria-labelledby="headingCourse{{ $course->id }}" data-bs-parent="#courseAccordion">
                        <div class="accordion-body">
                            <h5>🎯 CPL Terkait:</h5>
                            @if ($course->cpls->isEmpty())
                                <p class="text-muted">⚠ Belum ada CPL terkait.</p>
                            @else
                                <ul class="list-group">
                                    @foreach ($course->cpls as $cpl)
                                        <li class="list-group-item">
                                            <strong>{{ $cpl->code }}</strong> - {{ $cpl->description }}

                                            <ul class="mt-2">
                                                <li><strong>CPMK Terkait:</strong></li>
                                                @if ($cpl->cpmks->isEmpty())
                                                    <li class="text-muted">⚠ Tidak ada CPMK terkait.</li>
                                                @else
                                                    @foreach ($cpl->cpmks as $cpmk)
                                                        <li>📌 {{ $cpmk->code }} - {{ $cpmk->description }}</li>
                                                    @endforeach
                                                @endif
                                            </ul>
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
