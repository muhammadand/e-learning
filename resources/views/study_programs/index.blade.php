@extends('app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Daftar Program Studi</h1>
    <a href="{{ route('study_programs.create') }}" class="btn btn-primary mb-3">Tambah Program Studi</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Program Studi</th>
                <th>Fakultas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($studyPrograms as $studyProgram)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $studyProgram->name }}</td>
                    <td>{{ $studyProgram->faculty->name }}</td>
                    <td>
                        <a href="{{ route('study_programs.show', $studyProgram->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('study_programs.edit', $studyProgram->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('study_programs.destroy', $studyProgram->id) }}" method="POST" style="display:inline;">
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
