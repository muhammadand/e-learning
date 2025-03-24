@extends('layout')

@section('content')
<div class="container-fluid">

    
    <div class="row">
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <nav id="sidebar" class="sidebar-nav scroll-sidebar">
                    <div class="d-flex align-items-center mb-4 mt-7">
                        <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
                        <h3 class="fw-bold text-uppercase m-0">Sub-Cpmk</h3>
                    </div>
                    <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">
                    <ul class="sidebarnav">
                        @foreach ($uniqueSubCpmks as $subCpmk)
                            <li class="sidebar-item">
                                <a class="sidebar-link cursor-pointer"
                                   onclick="showContent({{ $subCpmk->id }})">
                                    <i class="ti ti-book me-2"></i>
                                    {{ Str::limit($subCpmk->description, 10, '...') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    
                    </div>
                </nav>
            </div>
        </aside>
        

        <!-- Content Area -->
        <main class="ms-sm-auto col-lg-11 px-md-4">
            <div class="ms-sm-auto col-lg-10 mt-7">
                <div class="progress mb-3">
                    <div class="progress-bar bg-success" role="progressbar" 
                        style="width: {{ number_format($progress, 0) }}%;" 
                        aria-valuenow="{{ number_format($progress, 0) }}" 
                        aria-valuemin="0" aria-valuemax="100">
                        {{ number_format($progress, 0) }}%
                    </div>
                </div>
            </div>
           
                <div id="materials-content">
                </div>
                <div id="quizzes-content">
                </div>
        </main>
    </div>
</div>

<script>
    function showContent(subCpmkId) {
        // Tampilkan indikator loading
        document.getElementById('materials-content').innerHTML = "<p class='text-muted'>Memuat materi...</p>";
        document.getElementById('quizzes-content').innerHTML = "<p class='text-muted'>Memuat kuis...</p>";

        // Load Materi
        fetch(`/materials/${subCpmkId}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('materials-content').innerHTML = html;
            })
            .catch(error => {
                document.getElementById('materials-content').innerHTML = "<p class='text-danger'>Gagal memuat materi.</p>";
            });

        // Load Kuis
        fetch(`/quizzes/${subCpmkId}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('quizzes-content').innerHTML = html;
            })
            .catch(error => {
                document.getElementById('quizzes-content').innerHTML = "<p class='text-danger'>Gagal memuat kuis.</p>";
            });
    }
</script>
@endsection
