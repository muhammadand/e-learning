@extends('app')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h3 class="fw-bold text-uppercase m-0">
            <i class="bi bi-journal-code text-primary me-2"></i> Create CPMKS
        </h3>
        <a href="{{ route('cpmks.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
    <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">

    <form action="{{ route('cpmks.store') }}" method="POST" class="p-4 border rounded shadow-sm bg-white">
        @csrf

        {{-- Pilih Mata Kuliah --}}
        <div class="mb-3">
            <label for="course_id" class="form-label fw-semibold">Mata Kuliah</label>
            <select name="course_id" id="course_id" class="form-select" required>
                <option value="" disabled selected>-- Pilih Mata Kuliah --</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Pilih CPL --}}
        <div class="mb-3">
            <label for="cpl_id" class="form-label fw-semibold">CPL</label>
            <select name="cpl_id" id="cpl_id" class="form-select" required>
                <option value="" disabled selected>-- Pilih CPL --</option>
            </select>
        </div>

        {{-- Tambah CPMK --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">CPMK</label>
            <div id="cpmk-container" class="border rounded p-3">
                <div class="input-group mb-2">
                    <input type="text" name="cpmks[0][code]" class="form-control" placeholder="Kode CPMK" required>
                    <input type="text" name="cpmks[0][description]" class="form-control" placeholder="Deskripsi CPMK" required>
                    <button type="button" class="btn btn-outline-danger remove-cpmk">
                        <iconify-icon icon="mdi:trash-can-outline" class="text-danger fs-5"></iconify-icon>

                    </button>
                </div>
            </div>
            <button type="button" id="add-cpmk" class="btn btn-primary mt-2">
                <i class="bi bi-plus-lg"></i> Tambah CPMK
            </button>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Simpan
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let cpmkIndex = 1;
        let courseCplMap = @json($courseCplMap);

        // Saat Course dipilih, tampilkan hanya CPL yang berelasi
        document.getElementById('course_id').addEventListener('change', function () {
            let selectedCourse = this.value;
            let cplDropdown = document.getElementById('cpl_id');

            cplDropdown.innerHTML = '<option value="" disabled selected>-- Pilih CPL --</option>';

            if (courseCplMap[selectedCourse]) {
                courseCplMap[selectedCourse].forEach(cpl => {
                    let option = document.createElement('option');
                    option.value = cpl.id;
                    option.textContent = `${cpl.code} - ${cpl.description}`;
                    cplDropdown.appendChild(option);
                });
            }
        });

        // Tambah input CPMK baru
        document.getElementById('add-cpmk').addEventListener('click', function () {
            let container = document.getElementById('cpmk-container');
            let newField = `
                <div class="input-group mb-2">
                    <input type="text" name="cpmks[${cpmkIndex}][code]" class="form-control" placeholder="Kode CPMK" required>
                    <input type="text" name="cpmks[${cpmkIndex}][description]" class="form-control" placeholder="Deskripsi CPMK" required>
                    <button type="button" class="btn btn-outline-danger remove-cpmk">
                         <iconify-icon icon="mdi:trash-can-outline" class="text-danger fs-5"></iconify-icon>
                    </button>
                </div>`;
            container.insertAdjacentHTML('beforeend', newField);
            cpmkIndex++;
        });

        // Hapus CPMK yang ditambahkan
        document.getElementById('cpmk-container').addEventListener('click', function (e) {
            if (e.target.closest('.remove-cpmk')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>
@endsection
