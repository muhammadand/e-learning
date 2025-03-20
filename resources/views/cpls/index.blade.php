@extends('app')

@section('content')
<div class="container-fluid">
   <!-- Judul dengan desain menarik -->
   <div class="d-flex align-items-center mb-4">
    <iconify-icon icon="mdi:book-open" class="fs-6 text-primary me-2"></iconify-icon>
    <h3 class="fw-bold text-uppercase m-0">Capaian Pembelajaran</h3>
</div>
    <hr class="mb-4 border-primary opacity-75" style="height: 3px; width: 200px;">
    <a href="{{ route('cpls.create') }}" class="btn btn-primary mb-3">Tambah CPL</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cpls as $cpl)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cpl->code }}</td>
                    <td>{{ $cpl->description }}</td>
                    <td>
                        <a href="{{ route('cpls.show', $cpl->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('cpls.edit', $cpl->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('cpls.destroy', $cpl->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
