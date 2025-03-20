@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Daftar Konten - {{ $course->name }}</h1>
    <a href="{{ route('course_contents.create', $course->id) }}" class="btn btn-primary mb-3">Tambah Konten</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Konten</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($course->contents as $content)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $content->name }}</td>
                    <td>
                        <form action="{{ route('course_contents.destroy', ['course' => $course->id, 'id' => $content->id]) }}" method="POST" style="display:inline;">
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
