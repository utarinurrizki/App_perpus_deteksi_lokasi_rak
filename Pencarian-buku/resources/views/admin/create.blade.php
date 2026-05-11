@extends('admin.layout')

@section('title', 'Tambah Buku')

@section('content')
<div class="card shadow-sm p-4">
    <h4 class="mb-4">Tambah Data Buku</h4>

    <form action="/admin/store" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Judul</label>
                <input name="judul" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Pengarang</label>
                <input name="pengarang" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Penerbit</label>
                <input name="penerbit" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>ISBN</label>
                <input name="isbn" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label>Jumlah Halaman</label>
                <input name="jumlah_halaman" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label>Edisi</label>
                <input name="edisi" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label>Jumlah Buku</label>
                <input type="number" name="jumlah_buku" class="form-control" min="0" value="0" required>
            </div>

            {{-- <div class="col-md-3 mb-3">
                <label>Status Buku</label>
                <select name="status" class="form-select" required>
                    <option value="tersedia">Tersedia</option>
                    <option value="tidak tersedia">Tidak Tersedia</option>
                </select>
            </div> --}}


            <div class="col-md-3 mb-3">
                <label>Tahun</label>
                <input type="number" name="tahun" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label>Kategori</label>
                <input name="kategori" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Rak</label>
                <select name="rak_id" class="form-select" required>
                    <option value="">-- Pilih Rak --</option>
                    @foreach($racks as $rack)
                        <option value="{{ $rack->id }}">
                            {{ $rack->nama_rak }} - {{ $rack->lokasi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Cover</label>
                <input type="file" name="cover" class="form-control">
            </div>
        </div>

        <div class="mt-3">
            <a href="/admin/books" class="btn btn-secondary">Kembali</a>
            <button class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection