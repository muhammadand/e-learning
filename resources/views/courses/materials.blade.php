<div class="ms-sm-auto col-lg-10">
    @if ($subCpmk->materials->isEmpty())
    <div class="d-flex align-items-center mb-4 mt-7">
        <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
        <h3 class="fw-bold text-uppercase m-0">Material</h3>
    </div>
        <p class="text-muted text-center">Tidak ada materi untuk Sub-CPMK ini.</p>
    @else
    <div class="d-flex align-items-center mb-4 mt-7">
        <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
        <h3 class="fw-bold text-uppercase m-0">Material</h3>
    </div>
        <div class="list-group list-group-flush">
            @foreach ($subCpmk->materials as $material)
                @php
                    $progress = \App\Models\UserProgress::where('user_id', auth()->id())
                        ->where('material_id', $material->id)
                        ->first();
                @endphp
                <a href="{{ route('materials.detail', $material->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 shadow-sm border rounded mb-2" style="transition: all 0.3s; text-decoration: none;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-book text-primary me-3" style="font-size: 1.5rem;"></i> 
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">{{ $material->title }}</h6>
                            <p class="text-muted small mb-0">{{ Str::limit($material->description, 100) }}</p>
                        </div>
                    </div>
                    <span class="badge {{ $progress && $progress->is_material_done ? 'bg-success' : 'bg-warning' }}">
                        {{ $progress && $progress->is_material_done ? 'Selesai' : 'Belum Selesai' }}
                    </span>
                </a>
            @endforeach
        </div>
    @endif
</div>
