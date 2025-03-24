@extends('app')

@section('content')
<div class="container-fluid">
    <!-- Header Quiz -->
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h3 class="fw-bold text-uppercase text-primary m-0">
                <i class="bi bi-pencil-square me-2"></i>{{ $quiz->title }}
            </h3>
            <p class="text-muted">{{ $quiz->description }}</p>
        </div>
        <div id="timer" class="badge bg-danger fs-5 p-2">
            00:30:00
        </div>
    </div>
    <hr class="border-primary opacity-75" style="height: 3px; width: 200px;">

    <!-- Progress Bar -->
    <div class="progress mb-4" style="height: 8px;">
        <div id="quizProgress" class="progress-bar bg-primary" style="width: 0%;"></div>
    </div>

    <!-- Form Quiz -->
    <form action="{{ route('quizzes.attempt.store') }}" method="POST">
        @csrf
        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

        @foreach ($quiz->questions as $question)
            <div class="card mb-3 shadow-sm border rounded">
                <div class="card-body">
                    <h5 class="fw-bold">{{ $loop->iteration }}. {{ $question->question_text }}</h5>
                    
                    @foreach (['A', 'B', 'C', 'D'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" 
                                name="answers[{{ $question->id }}]" value="{{ $option }}" required 
                                onchange="updateProgress()">
                            <label class="form-check-label">
                                {{ $question['option_' . strtolower($option)] }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary w-20 py-2">Kirim Jawaban</button>
    </form>
</div>

<!-- Timer & Progress Script -->
<script>
    // Timer Countdown
    let timeLeft = 30 * 60;
    const timerElement = document.getElementById('timer');
    function startTimer() {
        setInterval(() => {
            if (timeLeft <= 0) {
                alert("Waktu Habis! Jawaban akan dikirim otomatis.");
                document.querySelector("form").submit();
            }
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            timerElement.innerText = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            timeLeft--;
        }, 1000);
    }
    startTimer();

    // Progress Bar
    function updateProgress() {
        let totalQuestions = {{ count($quiz->questions) }};
        let answered = document.querySelectorAll("input:checked").length;
        let progress = (answered / totalQuestions) * 100;
        document.getElementById('quizProgress').style.width = progress + "%";
    }
</script>
@endsection