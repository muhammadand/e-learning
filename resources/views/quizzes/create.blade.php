@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm border-0">
                <div class="d-flex align-items-center mb-4">
                    <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
                    <h3 class="fw-bold text-uppercase m-0">Tambah Kuis untuk Sub CPMK: {{ $subCpmk->name }}</h3>
                </div>
                <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">
                
                <div class="card-body">
                    <form action="{{ route('quizzes.store', ['sub_cpmk_id' => $subCpmk->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="sub_cpmk_id" value="{{ $subCpmk->id }}">

                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Judul Kuis</label>
                            <input type="text" name="title" class="form-control" placeholder="Masukkan judul kuis" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Tambahkan deskripsi kuis"></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
