@extends('admin.layout')

@section('title', 'Edit Rak')

@section('content')
<div class="card shadow-sm p-4 border-0" style="border-radius: 20px;">
    <h4 class="mb-4" style="font-weight: 700; color: #1E293B;">Edit Data Rak</h4>

    <form action="{{ route('admin.racks.update', $rack->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" style="font-weight: 600;">Nama Rak</label>
                <input name="nama_rak" class="form-control" required value="{{ old('nama_rak', $rack->nama_rak) }}" style="border-radius: 10px;">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" style="font-weight: 600;">Zona</label>
                <input name="zona" class="form-control" required value="{{ old('zona', $rack->zona) }}" style="border-radius: 10px;">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label" style="font-weight: 600;">Baris</label>
                <input type="number" name="baris" class="form-control" min="0" required value="{{ old('baris', $rack->baris) }}" style="border-radius: 10px;">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label" style="font-weight: 600;">Sekat Mulai</label>
                <input type="number" name="sekat_mulai" class="form-control" min="0" required value="{{ old('sekat_mulai', $rack->sekat_mulai) }}" style="border-radius: 10px;">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label" style="font-weight: 600;">Sekat Selesai</label>
                <input type="number" name="sekat_selesai" class="form-control" min="0" required value="{{ old('sekat_selesai', $rack->sekat_selesai) }}" style="border-radius: 10px;">
            </div>
        </div>

        <div class="mt-4">
            <a href="/admin/racks" class="btn btn-secondary px-4" style="border-radius: 10px;">Kembali</a>
            <button class="btn btn-primary px-4" style="border-radius: 10px; background: linear-gradient(135deg,#3B5998,#2C4A7C); border: none;">Update</button>
        </div>
    </form>
</div>
@endsection
