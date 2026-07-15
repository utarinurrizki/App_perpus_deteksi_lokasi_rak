@extends('admin.layout')

@section('title', 'Dashboard')

@push('styles')
<style>

    .dashboard-header{
        background:
            linear-gradient(135deg,#3B5998 0%,#2C4A7C 50%,#1E293B 100%);
        border-radius:28px;
        padding:40px;
        color:white;
        position:relative;
        overflow:hidden;
        margin-bottom:30px;
    }

    .dashboard-header::before{
        content:'';
        position:absolute;
        right:-80px;
        top:-80px;
        width:250px;
        height:250px;
        background:rgba(255,255,255,.08);
        border-radius:50%;
    }

    .dashboard-header h1{
        font-size:36px;
        font-weight:800;
        margin-bottom:10px;
    }

    .dashboard-header p{
        max-width:650px;
        opacity:.9;
        margin-bottom:18px;
    }

    .dashboard-date{
        display:inline-flex;
        align-items:center;
        gap:10px;
        background:rgba(255,255,255,.12);
        padding:12px 18px;
        border-radius:14px;
        backdrop-filter:blur(10px);
    }

    /* STATS */

    .stat-card{
        background:white;
        border-radius:24px;
        padding:28px;
        height:100%;
        position:relative;
        overflow:hidden;
        transition:.3s;
        box-shadow:0 10px 35px rgba(15,23,42,.05);
    }

    .stat-card:hover{
        transform:translateY(-4px);
    }

    .stat-card::before{
        content:'';
        position:absolute;
        right:-30px;
        top:-30px;
        width:120px;
        height:120px;
        border-radius:50%;
        background:rgba(59,89,152,.06);
    }

    .stat-icon{
        width:65px;
        height:65px;
        border-radius:18px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:24px;
        margin-bottom:18px;
        color:white;
    }

    .icon-books{
        background:linear-gradient(135deg,#4F7BFF,#3B5998);
    }

    .icon-racks{
        background:linear-gradient(135deg,#60C689,#3CB371);
    }

    .icon-cover{
        background:linear-gradient(135deg,#F6B73C,#F39C12);
    }

    .icon-cat{
        background:linear-gradient(135deg,#A56CFF,#7B4DFF);
    }

    .stat-label{
        color:#7B8794;
        font-size:14px;
        margin-bottom:6px;
    }

    .stat-value{
        font-size:38px;
        font-weight:800;
        color:#1E293B;
        line-height:1;
    }

    .stat-desc{
        margin-top:12px;
        color:#7B8794;
        font-size:14px;
    }

    /* TABLE */

    .dashboard-panel{
        background:white;
        border-radius:26px;
        overflow:hidden;
        box-shadow:0 10px 35px rgba(15,23,42,.05);
    }

    .panel-header{
        padding:24px 28px;
        border-bottom:1px solid #EEF2F7;
        display:flex;
        justify-content:space-between;
        align-items:center;
        flex-wrap:wrap;
        gap:10px;
    }

    .panel-header h4{
        margin:0;
        font-size:22px;
        font-weight:700;
        color:#243041;
    }

    .panel-header p{
        margin:0;
        color:#7B8794;
        font-size:14px;
    }

    .table-modern{
        margin:0;
    }

    .table-modern thead th{
        background:#F8FAFC;
        border:none;
        color:#7B8794;
        font-size:12px;
        text-transform:uppercase;
        letter-spacing:.5px;
        padding:18px 24px;
    }

    .table-modern tbody td{
        padding:20px 24px;
        border-color:#F1F5F9;
        vertical-align:middle;
    }

    .table-modern tbody tr:hover{
        background:#FAFBFD;
    }

    .book-title{
        font-weight:700;
        color:#243041;
    }

    .badge-modern{
        background:#EEF3FF;
        color:#3B5998;
        padding:8px 14px;
        border-radius:999px;
        font-size:12px;
        font-weight:600;
    }

    .empty-data{
        padding:60px 20px;
        text-align:center;
        color:#94A3B8;
    }

    .empty-data i{
        font-size:60px;
        margin-bottom:15px;
        opacity:.3;
    }

</style>
@endpush

@section('content')

<!-- HERO -->
<div class="dashboard-header">

    <h1>Dashboard Admin</h1>

    <p>
        Selamat datang di sistem informasi perpustakaan.
        Kelola data buku, anggota, dan rak perpustakaan dengan tampilan modern dan lebih interaktif.
    </p>

    <div class="dashboard-date">
        <i class="fas fa-calendar-days"></i>
        {{ now()->format('d F Y') }}
    </div>

</div>

<!-- STATS -->
<div class="row g-4 mb-4">

    <div class="col-md-6 col-xl-3">

        <div class="stat-card">

            <div class="stat-icon icon-books">
                <i class="fas fa-book"></i>
            </div>

            <div class="stat-label">Total Buku</div>

            <div class="stat-value">
                {{ $stats['total_buku'] }}
            </div>

            <div class="stat-desc">
                Total seluruh koleksi buku perpustakaan.
            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="stat-card">

            <div class="stat-icon icon-racks">
                <i class="fas fa-layer-group"></i>
            </div>

            <div class="stat-label">Total Kode Klasifikasi</div>

            <div class="stat-value">
                {{ $stats['total_rak'] }}
            </div>

            <div class="stat-desc">
                Jumlah kode klasifikasi penyimpanan buku.
            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="stat-card">

            <div class="stat-icon icon-cover">
                <i class="fas fa-image"></i>
            </div>

            <div class="stat-label">Tanpa Cover</div>

            <div class="stat-value">
                {{ $stats['buku_tanpa_cover'] }}
            </div>

            <div class="stat-desc">
                Buku yang belum memiliki sampul.
            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="stat-card">

            <div class="stat-icon icon-cat">
                <i class="fas fa-tags"></i>
            </div>

            <div class="stat-label">Kategori</div>

            <div class="stat-value">
                {{ $stats['kategori_unik'] }}
            </div>

            <div class="stat-desc">
                Jumlah kategori buku unik.
            </div>

        </div>

    </div>

</div>

<!-- TABLE -->
<div class="dashboard-panel">

    <div class="panel-header">

        <div>
            <h4>Buku Terbaru</h4>
            <p>Daftar buku terbaru yang ditambahkan ke sistem.</p>
        </div>

    </div>

    <div class="table-responsive">

        <table class="table table-modern align-middle">

            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($latestBooks as $book)

                    <tr>

                        <td class="book-title">
                            {{ $book->judul }}
                        </td>

                        <td>
                            {{ $book->pengarang }}
                        </td>

                        <td>

                            @if($book->kategori)

                                <span class="badge-modern">
                                    {{ $book->kategori }}
                                </span>

                            @else

                                <span class="text-muted">—</span>

                            @endif

                        </td>

                        <td>
                            {{ $book->tahun ?? '—' }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4">

                            <div class="empty-data">

                                <i class="fas fa-book-open"></i>

                                <h5>Belum Ada Data Buku</h5>

                                <p>
                                    Tambahkan buku baru melalui menu
                                    <strong>Data Buku</strong>.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection