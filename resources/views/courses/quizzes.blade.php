<div class="ms-sm-auto col-lg-10">
    @if ($subCpmk->quizzes->isEmpty())
        <p class="text-muted text-center">Belum ada kuis untuk sub-CPMK ini.</p>
    @else
        <div class="list-group list-group-flush">
            @foreach ($subCpmk->quizzes as $quiz)
                @php
                    $attempt = $quiz->attempts->where('user_id', Auth::id())->last();
                    $isCompleted = $attempt && $attempt->score >= 80;
                @endphp
                <a href="{{ $isCompleted ? '#' : route('quizzes.mulai', $quiz->id) }}" 
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 shadow-sm border rounded mb-2" 
                    style="transition: all 0.3s; text-decoration: none;">
                    
                    <div class="d-flex align-items-center">
                        <i class="bi bi-card-checklist text-danger me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">{{ $quiz->title }}</h6>
                            <p class="text-muted small mb-0">{{ Str::limit($quiz->description, 100) }}</p>
                        </div>
                    </div>
                    
                    <span class="badge {{ $isCompleted ? 'bg-success' : 'bg-warning' }}">
                        {{ $isCompleted ? 'Sudah Selesai' : 'Belum Selesai' }}
                    </span>
                </a>
            @endforeach
        </div>
    @endif
</div>
