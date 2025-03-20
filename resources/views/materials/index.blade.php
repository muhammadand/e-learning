@extends('app')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4">
        <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
        <h3 class="fw-bold text-uppercase m-0">Kelola Materi</h3>
    </div>
    <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">
    
    <div class="text-right mt-4 mb-4">
        <a href="{{ route('materials.create') }}" class="btn btn-sm btn-primary shadow">+ Tambah Materi</a>
    </div>
    <div class="row">
        @foreach ($courses as $course)
            <div class="col-lg-6 col-md-12">
                <div class="card mb-4 shadow-lg border-0 rounded">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">
                            <a href="#" class="text-decoration-none text-dark" data-bs-toggle="collapse" data-bs-target="#course-{{ $course->id }}">
                                <i class="bi bi-journal-bookmark-fill text-primary"></i> {{ $course->name }}
                            </a>
                        </h5>
                        <p class="text-muted">{{ $course->description }}</p>

                        <div id="course-{{ $course->id }}" class="collapse">
                            <ul class="list-group list-group-flush">
                                @forelse ($course->materials as $material)
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">{{ $material->title }}</div>
                                            <p class="small text-muted">{{ $material->description }}</p>
                                            <small class="badge bg-secondary">CPMK: {{ $material->cpmk->code }}</small>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            @if($material->file_path)
                                                <a href="{{ asset('storage/' . $material->file_path) }}" class="btn btn-sm btn-outline-success" target="_blank">Download</a>
                                            @endif
                                            <a href="{{ route('materials.show', $material->id) }}" class="btn btn-sm btn-outline-info">Lihat</a>
                                            <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                            <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus materi ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item text-muted text-center">Belum ada materi.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection