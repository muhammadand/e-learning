@extends('app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4>Tambah Sub CPMK</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('sub_cpmks.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="cpmk_id" class="form-label">CPMK</label>
                    <select name="cpmk_id" id="cpmk_id" class="form-control">
                        <option value="">-- Pilih CPMK --</option>
                        @foreach($cpmks as $cpmk)
                            <option value="{{ $cpmk->id }}">{{ $cpmk->code }} - {{ $cpmk->description }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="code" class="form-label">Kode Sub CPMK</label>
                    <input type="text" name="code" id="code" class="form-control" placeholder="Masukkan kode (misal: SUB-CPMK1)">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Deskripsi Sub CPMK"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('sub_cpmks.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
