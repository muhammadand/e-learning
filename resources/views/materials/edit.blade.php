@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Edit Materi</h1>
    <form action="{{ route('materials.update', $material->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Judul Materi -->
        <div class="mb-3">
            <label for="title" class="form-label">Judul Materi</label>
            <input type="text" name="title" class="form-control" value="{{ $material->title }}" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ $material->description }}</textarea>
        </div>

        <!-- Upload File -->
        <div class="mb-3">
            <label for="file_path" class="form-label">Upload File</label>
            <input type="file" name="file_path" class="form-control">
            <p class="text-muted">File sebelumnya: <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank">{{ basename($material->file_path) }}</a></p>
        </div>

        <!-- Pilih Mata Kuliah -->
        <div class="mb-3">
            <label for="course_id" class="form-label">Mata Kuliah</label>
            <select name="course_id" id="course_id" class="form-control">
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $material->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Sub-CPMK -->
        <div class="mb-3">
            <label for="sub_cpmk_id" class="form-label">Sub-CPMK</label>
            <select name="sub_cpmk_id" id="sub_cpmk_id" class="form-control">
                <option value="">-- Pilih Sub-CPMK --</option>
                @foreach ($subCpmks as $subCpmk)
                    <option value="{{ $subCpmk->id }}" data-course="{{ $subCpmk->course_id }}" 
                        {{ $material->sub_cpmk_id == $subCpmk->id ? 'selected' : '' }}>
                        {{ $subCpmk->code }} - {{ $subCpmk->course->name }} - {{ $subCpmk->description }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('materials.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<!-- JavaScript untuk Filter Sub-CPMK Tanpa AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let selectedCourse = $('#course_id').val();
        filterSubCPMK(selectedCourse);

        $('#course_id').change(function() {
            let selectedCourse = $(this).val();
            filterSubCPMK(selectedCourse);
            $('#sub_cpmk_id').val('');
        });

        function filterSubCPMK(courseId) {
            $('#sub_cpmk_id option').each(function() {
                if ($(this).data('course') == courseId || $(this).val() == '') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
</script>
@endsection