@if($quizzes->isEmpty())
    <p class="text-muted">Belum ada kuis untuk Sub-CPMK ini.</p>
@else
    <ul class="list-group">
        @foreach($quizzes as $quiz)
            <li class="list-group-item">
                <strong>{{ $quiz->title }}</strong>
                <br><small>{{ $quiz->description }}</small>
                <br>
                <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-sm btn-primary mt-2">Mulai Kuis</a>
            </li>
        @endforeach
    </ul>
@endif
