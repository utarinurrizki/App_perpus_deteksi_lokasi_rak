@extends('admin.layout')

@section('title','Detail Buku')

@section('content')

<style>

.detail-card{
    background:#fff;
    border:none;
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 10px 35px rgba(15,23,42,.05);
}

.book-cover{
    width:100%;
    height:420px;
    object-fit:contain;
    object-position:center;
    background:#F8FAFC;
    border-radius:20px;
    border:1px solid #EEF2F7;
    padding:12px;
}

.no-cover{
    height:420px;
    border-radius:20px;
    background:#F8FAFC;
    border:1px dashed #CBD5E1;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    color:#94A3B8;
}

.no-cover i{
    font-size:60px;
    margin-bottom:10px;
}

.book-title{
    font-size:30px;
    font-weight:800;
    color:#1E293B;
    margin-bottom:8px;
}

.book-author{
    color:#64748B;
    font-size:15px;
    margin-bottom:25px;
}

.stat-card{
    background:white;
    border:1px solid #EEF2F7;
    border-radius:18px;
    padding:18px;
    text-align:center;
    height:100%;
    transition:.25s;
}

.stat-card:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(15,23,42,.08);
}

.stat-number{
    font-size:22px;
    font-weight:800;
    color:#3B5998;
}

.stat-label{
    font-size:13px;
    color:#64748B;
}

.info-box{
    background:#F8FAFC;
    border:1px solid #EEF2F7;
    border-radius:16px;
    padding:16px;
    height:100%;
}

.info-label{
    font-size:11px;
    color:#94A3B8;
    text-transform:uppercase;
    letter-spacing:.5px;
    margin-bottom:6px;
}

.info-value{
    font-size:15px;
    font-weight:600;
    color:#1E293B;
}

.status-available{
    background:#ECFDF3;
    color:#027A48;
    padding:8px 14px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
}

.status-empty{
    background:#FEF3F2;
    color:#B42318;
    padding:8px 14px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
}

.btn-back{
    background:#E2E8F0;
    color:#334155;
    border:none;
    border-radius:12px;
    padding:10px 18px;
    font-weight:600;
}

.btn-back:hover{
    background:#CBD5E1;
}

.btn-edit-book{
    background:linear-gradient(135deg,#3B5998,#2C4A7C);
    color:white;
    border:none;
    border-radius:12px;
    padding:10px 18px;
    font-weight:600;
}

.btn-edit-book:hover{
    color:white;
    transform:translateY(-2px);
}

.section-title{
    font-size:18px;
    font-weight:700;
    color:#1E293B;
    margin-bottom:20px;
}

.rack-location{
    margin-top:30px;
    background:#F8FAFC;
    border:1px solid #E2E8F0;
    border-radius:18px;
    padding:22px;
}

.rack-location-title{
    font-size:18px;
    font-weight:700;
    color:#1E293B;
    margin-bottom:18px;
    display:flex;
    align-items:center;
}

.location-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:12px 0;
    border-bottom:1px solid #E2E8F0;
}

.location-item:last-child{
    border-bottom:none;
}

.location-label{
    color:#64748B;
    font-weight:600;
}

.location-value{
    color:#1E293B;
    font-weight:700;
}

</style>

<div class="detail-card">

    <div class="p-4 p-lg-5">

        <div class="row g-4">

            <!-- COVER -->
            <div class="col-lg-3">

                @if($book->cover)

                    <img src="/images/cover/{{ $book->cover }}"
                         class="book-cover">

                @else

                    <div class="no-cover">

                        <i class="fas fa-book"></i>

                        <span>No Cover</span>

                    </div>

                @endif

            </div>

            <!-- DETAIL -->
            <div class="col-lg-9">

                <div class="book-title">
                    {{ $book->judul }}
                </div>

                <div class="book-author">
                    <i class="fas fa-user-edit me-2"></i>
                    {{ $book->pengarang }}
                </div>

                <!-- STATISTIK -->
                <div class="row g-3 mb-4">

                    <div class="col-lg-3 col-md-6">

                        <div class="stat-card">

                            <div class="stat-number">
                                {{ $book->jumlah_buku }}
                            </div>

                            <div class="stat-label">
                                Jumlah Buku
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="stat-card">

                            <div class="stat-number">
                                {{ $book->tahun ?? '-' }}
                            </div>

                            <div class="stat-label">
                                Tahun Terbit
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6">

                        <div class="stat-card">

                            <div class="stat-number">
                                {{ optional($book->rack)->nama_rak ?? '-' }}
                            </div>

                            <div class="stat-label">
                                No.Klasifikasi
                            </div>

                        </div>

                    </div>


                    @php
                        $pengarang = strtoupper(substr($book->pengarang, 0, 3));
                        $judul = strtoupper(substr(trim($book->judul), 0, 1));

                        $noPanggil = ($book->rack->nama_rak ?? '-') . ' ' . $pengarang . ' ' . $judul;
                    @endphp

                        <div class="col-lg-3 col-md-6">

                            <div class="stat-card">

                                <div class="stat-number">
                                    {{ $noPanggil }}
                                </div>

                                <div class="stat-label">
                                    No. Panggil
                                </div>

                            </div>

                        </div>
                </div>

                <div class="section-title">
                    Informasi Buku
                </div>

                <div class="row g-3">

                    <div class="col-md-6">

                        <div class="info-box">

                            <div class="info-label">
                                ISBN
                            </div>

                            <div class="info-value">
                                {{ $book->isbn ?: '-' }}
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-box">

                            <div class="info-label">
                                Penerbit
                            </div>

                            <div class="info-value">
                                {{ $book->penerbit }}
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-box">

                            <div class="info-label">
                                Jumlah Halaman
                            </div>

                            <div class="info-value">
                                {{ $book->jumlah_halaman ?: '-' }}
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-box">

                            <div class="info-label">
                                Edisi
                            </div>

                            <div class="info-value">
                                {{ $book->edisi ?: '-' }}
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-box">

                            <div class="info-label">
                                Kategori
                            </div>

                            <div class="info-value">
                                {{ $book->kategori ?: '-' }}
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-box">

                            <div class="info-label">
                                Status
                            </div>

                            @if($book->jumlah_buku > 0)

                                <span class="status-available">
                                    Tersedia
                                </span>

                            @else

                                <span class="status-empty">
                                    Tidak Tersedia
                                </span>

                            @endif

                        </div>

                    </div>

                    <div class="rack-location">

                        <h5 class="rack-location-title">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Lokasi Rak Buku
                        </h5>

                        @if($book->rack)

                            <div class="location-item">
                                <span class="location-label">Nomor Klasifikasi</span>
                                <span class="location-value">
                                    {{ $book->rack->nama_rak }}
                                </span>
                            </div>

                            <div class="location-item">
                                <span class="location-label">Zona</span>
                                <span class="location-value">
                                    {{ $book->rack->zona }}
                                </span>
                            </div>

                            <div class="location-item">
                                <span class="location-label">Baris</span>
                                <span class="location-value">
                                    {{ $book->rack->baris }}
                                </span>
                            </div>

                            <div class="location-item">
                                <span class="location-label">Sekat</span>
                                <span class="location-value">

                                    {{ $book->rack->sekat_mulai }}

                                    @if($book->rack->sekat_mulai != $book->rack->sekat_selesai)
                                        - {{ $book->rack->sekat_selesai }}
                                    @endif

                                </span>
                            </div>

                        @else

                            <div class="alert alert-warning mb-0">
                                Data lokasi rak belum tersedia.
                            </div>

                        @endif

</div>

                </div>

                <div class="mt-4 d-flex gap-2 flex-wrap">

                    <a href="/admin/books"
                       class="btn btn-back">

                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali

                    </a>

                    <a href="{{ route('admin.books.edit', $book->id) }}"
                       class="btn btn-edit-book">

                        <i class="fas fa-pen me-2"></i>
                        Edit Buku

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection