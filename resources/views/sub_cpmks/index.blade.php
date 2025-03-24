@extends('app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4>Daftar Sub CPMK</h4>
            <a href="{{ route('sub_cpmks.create') }}" class="btn btn-light">Tambah Sub CPMK</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Kode</th>
                        <th>Deskripsi</th>
                        <th>CPMK</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subCpmks as $subCpmk)
                        <tr>
                            <td>{{ $subCpmk->code }}</td>
                            <td>{{ $subCpmk->description }}</td>
                            <td>{{ $subCpmk->cpmk->code ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('sub_cpmks.edit', $subCpmk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                <a href="{{ route('quizzes.index', $subCpmk->id) }}" class="btn btn-info btn-sm">Kelola Kuis</a>
                                
                                <form action="{{ route('sub_cpmks.destroy', $subCpmk->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Sub CPMK ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
