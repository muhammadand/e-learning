@extends('app')

@section('content')
<div class="container-fluid">
    <h2>{{ $quiz->title }}</h2>
    <p>{{ $quiz->description }}</p>

    <form action="{{ route('quizzes.attempt.store') }}" method="POST">
        @csrf
        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

        @foreach ($quiz->questions as $question)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $loop->iteration }}. {{ $question->question_text }}</h5>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="A" required>
                        <label class="form-check-label">{{ $question->option_a }}</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="B">
                        <label class="form-check-label">{{ $question->option_b }}</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="C">
                        <label class="form-check-label">{{ $question->option_c }}</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" value="D">
                        <label class="form-check-label">{{ $question->option_d }}</label>
                    </div>
                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Kirim Jawaban</button>
    </form>
</div>
@endsection
