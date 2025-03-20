@extends('app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Daftar Fakultas</h1>
    <a href="{{ route('faculties.create') }}" class="btn btn-primary mb-3">Tambah </a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Fakultas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($faculties as $faculty)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $faculty->name }}</td>
                    <td>
                        <a href="{{ route('faculties.show', $faculty->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('faculties.edit', $faculty->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('faculties.destroy', $faculty->id) }}" method="POST" style="display:inline;">
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
