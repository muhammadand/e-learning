@extends('app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0 rounded-lg p-4">
        <h3 class="text-center fw-bold mb-3">Feedback untuk {{ $course->name }}</h3>

        {{-- Form Tambah Feedback --}}
        <form action="{{ route('feedback.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">

            {{-- Rating --}}
            <div class="mb-3 text-center">
                <label class="form-label fw-semibold">Beri Rating:</label>
                <div class="rating">
                    <input type="radio" name="rating" value="5" id="star5"><label for="star5" class="star">★</label>
                    <input type="radio" name="rating" value="4" id="star4"><label for="star4" class="star">★</label>
                    <input type="radio" name="rating" value="3" id="star3"><label for="star3" class="star">★</label>
                    <input type="radio" name="rating" value="2" id="star2"><label for="star2" class="star">★</label>
                    <input type="radio" name="rating" value="1" id="star1"><label for="star1" class="star">★</label>
                </div>
            </div>

            {{-- Komentar --}}
            <div class="mb-3">
                <label for="comment" class="form-label fw-semibold">Komentar Anda:</label>
                <textarea name="comment" class="form-control rounded-3 shadow-sm" rows="3" placeholder="Tulis masukan Anda di sini..."></textarea>
            </div>

            {{-- Tombol Kirim --}}
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4 rounded-pill">Kirim Feedback</button>
            </div>
        </form>

        {{-- Daftar Feedback --}}
        <h4 class="fw-bold">Apa kata mereka?</h4>
        <div class="list-group mt-3">
            @foreach($feedbacks as $feedback)
                <div class="list-group-item d-flex align-items-start gap-3 border-0 shadow-sm rounded-3 p-3">
                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        {{ strtoupper(substr($feedback->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <strong class="d-block">{{ $feedback->user->name }}</strong>
                        <span class="feedback-stars text-warning">{!! str_repeat('★', $feedback->rating) !!}{!! str_repeat('☆', 5 - $feedback->rating) !!}</span>
                        <p class="text-muted mt-1">{{ $feedback->comment }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- CSS untuk Rating --}}
<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
        font-size: 35px;
    }
    .rating input {
        display: none;
    }
    .rating label {
        cursor: pointer;
        color: #ddd;
        transition: color 0.3s ease;
        font-size: 40px;
    }
    .rating label:hover,
    .rating label:hover ~ label {
        color: gold;
    }
    .rating input:checked ~ label {
        color: gold;
    }
</style>

{{-- JS untuk Efek Rating --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.rating input').forEach(star => {
            star.addEventListener('change', function () {
                let value = this.value;
                document.querySelectorAll('.rating label').forEach(label => label.style.color = '#ddd');
                for (let i = 1; i <= value; i++) {
                    document.querySelector(`label[for="star${i}"]`).style.color = 'gold';
                }
            });
        });
    });
</script>
@endsection
