@extends('admin.layout')

@section('title', 'Tambah Rak')

@section('content')
<div class="card shadow-sm p-4 border-0" style="border-radius: 20px;">
    <h4 class="mb-4" style="font-weight: 700; color: #1E293B;">Tambah Data Rak</h4>

    <form action="{{ route('admin.racks.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" style="font-weight: 600;">Nama Rak</label>
                <input name="nama_rak" class="form-control" placeholder="Contoh: 000-000" required value="{{ old('nama_rak') }}" style="border-radius: 10px;">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" style="font-weight: 600;">Zona</label>
                <input name="zona" class="form-control" placeholder="Contoh: kiri atau kanan" required value="{{ old('zona') }}" style="border-radius: 10px;">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label" style="font-weight: 600;">Baris</label>
                <input type="number" name="baris" class="form-control" placeholder="Contoh: 1" min="0" required value="{{ old('baris') }}" style="border-radius: 10px;">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label" style="font-weight: 600;">Sekat Mulai</label>
                <input type="number" name="sekat_mulai" class="form-control" placeholder="Contoh: 1" min="0" required value="{{ old('sekat_mulai') }}" style="border-radius: 10px;">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label" style="font-weight: 600;">Sekat Selesai</label>
                <input type="number" name="sekat_selesai" class="form-control" placeholder="Contoh: 5" min="0" required value="{{ old('sekat_selesai') }}" style="border-radius: 10px;">
            </div>
        </div>

        <div class="mt-4">
            <a href="/admin/racks" class="btn btn-secondary px-4" style="border-radius: 10px;">Kembali</a>
            <button class="btn btn-primary px-4" style="border-radius: 10px; background: linear-gradient(135deg,#3B5998,#2C4A7C); border: none;">Simpan</button>
        </div>
    </form>
</div>
@endsection
