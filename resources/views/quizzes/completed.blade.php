@extends('app')

@section('content')
<div class="container-fluid text-center mt-5">
    <div class="position-relative">
        <h2 class="fw-bold text-success">🎉 Selamat! 🎉</h2>
        <h3 class="text-primary">Anda telah menyelesaikan kuis 🎯</h3>
    </div>
    
    <p class="mt-3 text-muted">Terima kasih telah menyelesaikan kuis ini. Semoga hasilnya memuaskan! 🎖️</p>

    <div class="mt-4">
        <a href="{{route('courses.enrol')}}" 
        class="btn btn-lg btn-primary shadow-sm">
         <i class="bi bi-arrow-left-circle"></i> Kembali ke Kursus
     </a>
     
    </div>
    
    

    <!-- Efek Confetti -->
    <div class="confetti-container"></div>
</div>

<!-- Script Confetti -->
<style>
    .confetti-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        overflow: hidden;
    }

    .confetti {
        width: 10px;
        height: 10px;
        position: absolute;
        background: red;
        opacity: 0.8;
        animation: confetti-fall linear infinite;
    }

    @keyframes confetti-fall {
        0% { transform: translateY(-10vh) rotate(0deg); opacity: 1; }
        100% { transform: translateY(100vh) rotate(360deg); opacity: 0; }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const confettiContainer = document.querySelector(".confetti-container");

        function createConfetti() {
            const confetti = document.createElement("div");
            confetti.classList.add("confetti");
            confetti.style.backgroundColor = `hsl(${Math.random() * 360}, 100%, 50%)`;
            confetti.style.left = `${Math.random() * 100}vw`;
            confetti.style.animationDuration = `${Math.random() * 3 + 2}s`;
            confettiContainer.appendChild(confetti);

            setTimeout(() => confetti.remove(), 5000);
        }

        setInterval(createConfetti, 200);
    });
</script>
@endsection
