@extends('admin.layout')

@section('title', 'Tambah Buku')

@section('content')
<div class="card shadow-sm p-4">
    <h4 class="mb-4">Tambah Data Buku</h4>

    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Judul</label>
                <input name="judul" class="form-control" required  value="{{ old('judul') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Pengarang</label>
                <input name="pengarang" class="form-control" required  value="{{ old('pengarang') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Penerbit</label>
                <input name="penerbit" class="form-control" required value="{{ old('penerbit') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>ISBN</label>
                <input name="isbn" class="form-control" required value="{{ old('isbn') }}">
            </div>

            <div class="col-md-3 mb-3">
                <label>Jumlah Halaman</label>
                <input name="jumlah_halaman" class="form-control" required value="{{ old('jumlah_halaman') }}">
            </div>

            <div class="col-md-3 mb-3">
                <label>Edisi</label>
                <input name="edisi" class="form-control" required value="{{ old('edisi') }}">
            </div>

            <div class="col-md-3 mb-3">
                <label>Jumlah Buku</label>
                <input type="number" name="jumlah_buku" class="form-control" min="0" value="{{ old('jumlah_buku', 0) }}" required>
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
                <input type="number" name="tahun" class="form-control" required value="{{ old('tahun') }}">
            </div>

            <div class="col-md-3 mb-3">
                <label>Kategori</label>
                <input name="kategori" class="form-control" required value="{{ old('kategori') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Klasifikasi</label>
                <select name="rak_id" class="form-select" required>
                    <option value="">-- Pilih Klasifikasi --</option>
                    @foreach($racks as $rack)
                      <option value="{{ $rack->id }}"
                            {{ old('rak_id') == $rack->id ? 'selected' : '' }}>

                            {{ $rack->nama_rak }}
                            |
                            Zona {{ $rack->zona }}
                            |
                            Baris {{ $rack->baris }}
                            |
                            Sekat {{ $rack->sekat_mulai }}
                            @if($rack->sekat_mulai != $rack->sekat_selesai)
                                - {{ $rack->sekat_selesai }}
                            @endif
            </option>
                    @endforeach
                </select>
            </div>

           <div class="col-md-6 mb-3">
            <label>Cover <span class="text-danger">*</span></label>
            <input type="file" name="cover" class="form-control" required>

            @error('cover')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

        <div class="mt-3">
            <a href="/admin/books" class="btn btn-secondary">Kembali</a>
            <button class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection