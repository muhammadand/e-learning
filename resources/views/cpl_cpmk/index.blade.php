@extends('app')

@section('content')
<div class="container-fluid">
    <h1>Relasi CPL → CPMK</h1>
    <a href="{{ route('cpl_cpmk.create') }}" class="btn btn-primary mb-3">Tambah Relasi</a>

    @if ($cplCpmks->isEmpty())
        <p class="text-muted">Belum ada data CPL, CPMK, dan Course.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>CPL</th>
                    <th>CPMK</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cplCpmks as $relasi)
                    <tr>
                        <td>{{ $relasi->course->name }}</td>
                        <td>{{ $relasi->cpl->code }} - {{ $relasi->cpl->description }}</td>
                        <td>{{ $relasi->cpmk->code }} - {{ $relasi->cpmk->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
