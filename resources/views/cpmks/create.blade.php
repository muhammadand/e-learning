@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Tambah CPMK</h1>
    <a href="{{ route('cpmks.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('cpmks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="course_id" class="form-label">Mata Kuliah</label>
            <select name="course_id" id="course_id" class="form-control" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cpl_id" class="form-label">CPL</label>
            <select name="cpl_id" id="cpl_id" class="form-control" required>
                <option value="">-- Pilih CPL --</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">CPMK</label>
            <div id="cpmk-container">
                <div class="input-group mb-2">
                    <input type="text" name="cpmks[0][code]" class="form-control" placeholder="Kode CPMK" required>
                    <input type="text" name="cpmks[0][description]" class="form-control" placeholder="Deskripsi CPMK" required>
                    <button type="button" class="btn btn-danger remove-cpmk">❌</button>
                </div>
            </div>
            <button type="button" id="add-cpmk" class="btn btn-primary">+ Tambah CPMK</button>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let cpmkIndex = 1;

        // Ambil data CPL dari Laravel
        let courseCplMap = @json($courseCplMap); 

        // Saat Course dipilih, tampilkan hanya CPL yang berelasi
        document.getElementById('course_id').addEventListener('change', function () {
            let selectedCourse = this.value;
            let cplDropdown = document.getElementById('cpl_id');

            cplDropdown.innerHTML = '<option value="">-- Pilih CPL --</option>';

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
                    <button type="button" class="btn btn-danger remove-cpmk">❌</button>
                </div>`;
            container.insertAdjacentHTML('beforeend', newField);
            cpmkIndex++;
        });

        // Hapus CPMK yang ditambahkan
        document.getElementById('cpmk-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-cpmk')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>
@endsection
