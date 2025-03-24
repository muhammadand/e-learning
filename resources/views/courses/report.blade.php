@extends('app')

@section('content')
<div class="container-fluid">
    <!-- Judul -->
    <div class="d-flex align-items-center mb-4">
        <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
        <h3 class="fw-bold text-uppercase m-0">Laporan Course: {{ $course->name }}</h3>
    </div>
    <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">


    <!-- Ringkasan Course -->
    <div class="d-flex flex-wrap gap-3 mb-4">
        <div class="p-4 bg-white shadow-sm rounded-4 flex-fill">
            <h6 class="text-muted">Total Mahasiswa</h6>
            <h4 class="fw-bold text-primary">{{ count($users) }}</h4>
        </div>
        <div class="p-4 bg-white shadow-sm rounded-4 flex-fill">
            <h6 class="text-muted">Dalam Proses</h6>
            <h4 class="fw-bold text-warning">{{ $inProgressUsers }}</h4>
        </div>
        <div class="p-4 bg-white shadow-sm rounded-4 flex-fill">
            <h6 class="text-muted">Sudah Selesai</h6>
            <h4 class="fw-bold text-success">{{ $completedUsers }}</h4>
        </div>
        <div class="p-4 bg-white shadow-sm rounded-4 flex-fill">
            <h6 class="text-muted">Total Materi</h6>
            <h4 class="fw-bold text-info">{{ $totalMaterials }}</h4>
        </div>
        <div class="p-4 bg-white shadow-sm rounded-4 flex-fill">
            <h6 class="text-muted">Total Quiz</h6>
            <h4 class="fw-bold text-danger">{{ $totalQuizzes }}</h4>
        </div>
    </div>

    <!-- Tabel Mahasiswa -->
    <div class="bg-white shadow-sm rounded-4 p-4">
        <h5 class="fw-bold mb-3"><i class="fas fa-users"></i> Detail Mahasiswa</h5>
        <div class="table-responsive">
            <table class="table table-hover text-center align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="rounded-start">Nama User</th>
                        <th>Materi Selesai</th>
                        @foreach($course->cpls->flatMap->cpmks->flatMap->subCpmks->flatMap->quizzes as $quiz)
                            <th>{{ $quiz->title }}</th>
                        @endforeach
                        <th>Rata-rata Nilai</th>
                        <th class="rounded-end">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userData as $data)
                        <tr>
                            <td class="fw-semibold">{{ $data['name'] }}</td>
                            <td>{{ $data['completed_materials'] }} / {{ $totalMaterials }}</td>
                            @foreach($course->cpls->flatMap->cpmks->flatMap->subCpmks->flatMap->quizzes as $quiz)
                                <td>{{ $data['quiz_scores'][$quiz->id] ?? '-' }}</td>
                            @endforeach
                            <td class="fw-bold">{{ $data['average_score'] }}</td>
                            <td>
                                @if($data['completed_materials'] == $totalMaterials)
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-warning text-dark">Dalam Proses</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection
