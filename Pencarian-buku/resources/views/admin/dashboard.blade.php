@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Dashboard</h4>
            <p class="text-muted mb-0">Ringkasan data yang berkaitan dengan pencarian buku.</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <small class="text-muted">Total Buku</small>
                <h3>{{ $stats['total_buku'] }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <small class="text-muted">Total Rak</small>
                <h3>{{ $stats['total_rak'] }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <small class="text-muted">Buku Tanpa Cover</small>
                <h3>{{ $stats['buku_tanpa_cover'] }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <small class="text-muted">Kategori Buku</small>
                <h3>{{ $stats['kategori_unik'] }}</h3>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <h5 class="mb-3">Buku Terbaru</h5>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Kategori</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestBooks as $book)
                        <tr>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->pengarang }}</td>
                            <td>{{ $book->kategori ?? '-' }}</td>
                            <td>{{ $book->tahun ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection