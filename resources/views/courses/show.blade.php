@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="my-3">{{ $course->name }}</h2> <!-- Nama Course -->
        </div>

        <!-- Sidebar CPL & CPMK -->
        <div class="col-md-3">
            <h4>Daftar CPL</h4>
            <div class="accordion" id="cplAccordion">
                @foreach ($course->cpls as $cpl)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $cpl->id }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $cpl->id }}">
                                {{ $cpl->code }} - {{ $cpl->description }}
                            </button>
                        </h2>
                        <div id="collapse{{ $cpl->id }}" class="accordion-collapse collapse" data-bs-parent="#cplAccordion">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    @foreach ($cpl->cpmks->where('course_id', $course->id) as $cpmk)
                                    <div class="list-group-item cpmk-item d-flex justify-content-between align-items-center p-3" data-cpmk-id="{{ $cpmk->id }}">
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="mb-1 text-primary fw-bold">{{ $cpmk->code }}</h6>
                                                @if ($cpmk->quizzes->count() > 0)
                                                    <a href="{{ route('quizzes.index', ['cpmk_id' => $cpmk->id]) }}" class="btn btn-outline-success btn-sm d-flex align-items-center">
                                                        <i class="bi bi-question-circle me-1"></i> Quizzes
                                                    </a>
                                                @endif
                                            </div>
                                            
                                            <p class="mb-2 text-muted">{{ $cpmk->description }}</p>
                                        </div>
                                       
                                    </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-9 d-flex flex-row gap-3">
            <!-- Konten Materi & Progress -->
            <div class="col-md-6 flex-grow-1">
                <h4>Materi</h4>
                <div class="progress mb-3">
                    <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        0%
                    </div>
                </div>
                <div id="materialsContent" class="card p-3">
                    <p>Pilih CPMK untuk melihat materi.</p>
                </div>
            </div>
        
            <!-- Jumlah User Aktif & Feedback -->
            <div class="card p-3 w-25">
                <p class="text-muted">Jumlah User Aktif: <strong>{{ $activeUsersCount }}</strong></p>
                <a href="{{ route('feedback.index', $course->id) }}" class="btn btn-success btn-sm">Tambahkan Feedback</a>
            </div>
        </div>
        
    </div>
    
</div>

<script>
   document.addEventListener("DOMContentLoaded", function () {
    const cpmkItems = document.querySelectorAll(".cpmk-item");
    const progressBar = document.getElementById("progressBar");

    function updateProgress() {
        fetch(`/progress/status/{{ $course->id }}`)
            .then(response => response.json())
            .then(data => {
                let percentage = data.percentage || 0;
                progressBar.style.width = percentage + "%";
                progressBar.setAttribute("aria-valuenow", percentage);
                progressBar.textContent = percentage + "%";
            });
    }

    function loadMaterials(cpmkId) {
    const materialsContent = document.getElementById("materialsContent");

    fetch(`/cpmk/${cpmkId}/materials`)
        .then(response => response.json())
        .then(data => {
            let html = data.length > 0 ? '<ul class="list-group">' : '<p>Belum ada materi untuk CPMK ini.</p>';
            
            data.forEach(material => {
                let buttonClass = material.is_completed ? 'btn-secondary' : 'btn-primary';
                let buttonDisabled = material.is_completed ? 'disabled' : '';
                let buttonText = material.is_completed ? 'Completed' : 'Mark as Done';

                html += `
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>${material.title}</strong>
                            <p>${material.description}</p>
                            ${material.file_path ? `<a href="/storage/${material.file_path}" class="btn btn-sm btn-success" target="_blank">Download Materi</a>` : ""}
                        </div>
                        <form action="/progress/complete/${material.id}" method="POST" class="complete-form">
                            @csrf
                            <button type="submit" class="btn btn-sm ${buttonClass}" ${buttonDisabled} data-material-id="${material.id}">
                                ${buttonText}
                            </button>
                        </form>
                    </li>`;
            });

            html += data.length > 0 ? '</ul>' : '';
            materialsContent.innerHTML = html;

            // Tambahkan event listener untuk tombol selesai
            document.querySelectorAll(".complete-form").forEach(form => {
                form.addEventListener("submit", function (e) {
                    e.preventDefault();
                    let button = this.querySelector("button");

                    fetch(this.action, {
                        method: "POST",
                        body: new FormData(this)
                    }).then(() => {
                        updateProgress();
                        button.classList.replace("btn-primary", "btn-secondary");
                        button.textContent = "Completed";
                        button.disabled = true;
                    });
                });
            });
        })
        .catch(() => {
            materialsContent.innerHTML = `<p class="text-danger">Terjadi kesalahan saat mengambil data.</p>`;
        });
}


    cpmkItems.forEach(item => {
        item.addEventListener("click", function () {
            const cpmkId = this.getAttribute("data-cpmk-id");

            // Reset warna semua CPMK
            cpmkItems.forEach(el => el.classList.remove("active-cpmk"));
            this.classList.add("active-cpmk");

            loadMaterials(cpmkId);
        });
    });

    updateProgress();
});

</script>

<style>
    .cpmk-item.active-cpmk {
        background-color: #007bff !important;
        color: white !important;
    }
</style>
@endsection