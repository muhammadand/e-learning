@extends('app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="d-flex align-items-center mb-4">
            <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
            <h3 class="fw-bold text-uppercase m-0">rencana Pembelajaran semester</h3>
        </div>
        <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th>Fakultas</th>
                            <td>{{ $course->user->studyProgram->faculty->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Program Studi</th>
                            <td>{{ $course->user->studyProgram->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Mata Kuliah</th>
                            <td>{{ $course->name }}</td>
                        </tr>
                        <tr>
                            <th>Kode Mata Kuliah</th>
                            <td>{{ $course->code }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th>Bobot (SKS)</th>
                            <td>{{ $course->sks }}</td>
                        </tr>
                        <tr>
                            <th>Semester</th>
                            <td>{{ $course->semester }}</td>
                        </tr>
                        <tr>
                            <th>Dosen Pengampu</th>
                            <td>{{ $course->user->name ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <div class="mt-3">
                <h5 class="text-primary">CPL (Capaian Pembelajaran Lulusan)</h5>
                @if ($course->cpls->isNotEmpty())
                    <ul class="list-group">
                        @foreach ($course->cpls as $cpl)
                            <li class="list-group-item">{{ $cpl->description }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Belum ada CPL yang tersedia.</p>
                @endif
            </div>

            <div class="mt-4">
                <h5 class="text-primary">CPMK (Capaian Pembelajaran Mata Kuliah)</h5>
                @if ($course->cpls->flatMap->cpmks->where('course_id', $course->id)->isNotEmpty())
                    <ul class="list-group">
                        @foreach ($course->cpls as $cpl)
                            @foreach ($cpl->cpmks->where('course_id', $course->id) as $cpmk)
                                <li class="list-group-item">
                                    <strong>{{ $cpmk->code }}</strong> - {{ $cpmk->description }}
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Belum ada CPMK yang tersedia.</p>
                @endif
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
