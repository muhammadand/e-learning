@extends('app')

@section('content')
<div class="container-fluid">
    <h3>Feedback untuk {{ $course->name }}</h3>

    {{-- Form Tambah Feedback --}}
    <form action="{{ route('feedback.store') }}" method="POST">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course->id }}">

        <label for="rating">Rating:</label>
        <div class="rating">
            <input type="radio" name="rating" value="5" id="star5"><label for="star5" class="star">★</label>
            <input type="radio" name="rating" value="4" id="star4"><label for="star4" class="star">★</label>
            <input type="radio" name="rating" value="3" id="star3"><label for="star3" class="star">★</label>
            <input type="radio" name="rating" value="2" id="star2"><label for="star2" class="star">★</label>
            <input type="radio" name="rating" value="1" id="star1"><label for="star1" class="star">★</label>
        </div>

        <label for="comment">Komentar:</label>
        <textarea name="comment" class="form-control" rows="3"></textarea>

        <button type="submit" class="btn btn-primary mt-2">Kirim Feedback</button>
    </form>

    {{-- Daftar Feedback --}}
    <h4 class="mt-4">Daftar Feedback</h4>
    <ul class="list-group">
        @foreach($feedbacks as $feedback)
            <li class="list-group-item">
                <strong>{{ $feedback->user->name }}</strong> - 
                <span class="feedback-stars">{!! str_repeat('★', $feedback->rating) !!}{!! str_repeat('☆', 5 - $feedback->rating) !!}</span>
                <p>{{ $feedback->comment }}</p>
            </li>
        @endforeach
    </ul>
</div>

{{-- CSS untuk Rating --}}
<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: start;
        font-size: 30px;
    }
    .rating input {
        display: none;
    }
    .rating label {
        cursor: pointer;
        color: gray;
        transition: color 0.3s;
        font-size: 35px;
    }
    .rating label:hover,
    .rating label:hover ~ label {
        color: gold;
    }
    .rating input:checked ~ label {
        color: gold;
    }
</style>

{{-- JS untuk efek klik agar semua bintang kiri ikut aktif --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stars = document.querySelectorAll('.rating input');
        
        stars.forEach(star => {
            star.addEventListener('change', function () {
                let value = this.value; // Ambil nilai rating yang dipilih

                // Ubah semua bintang menjadi abu-abu dulu
                document.querySelectorAll('.rating label').forEach(label => {
                    label.style.color = 'gray';
                });

                // Aktifkan semua bintang sampai nilai yang diklik
                for (let i = 1; i <= value; i++) {
                    document.querySelector(`label[for="star${i}"]`).style.color = 'gold';
                }
            });
        });
    });
</script>
@endsection
