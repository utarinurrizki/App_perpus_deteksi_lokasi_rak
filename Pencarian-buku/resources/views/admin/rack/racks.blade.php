@extends('admin.layout')

@section('title', 'Data Rak')

@push('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 24px;
    }

    .page-title h3 {
        margin: 0;
        font-size: 26px;
        font-weight: 800;
        color: #1E293B;
    }

    .header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-modern {
        border: none;
        border-radius: 14px;
        padding: 10px 16px;
        font-weight: 600;
        font-size: 13px;
        transition: .25s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-add {
        background: linear-gradient(135deg, #3B5998, #2C4A7C);
        color: white;
        box-shadow: 0 10px 25px rgba(59, 89, 152, .20);
    }

    .btn-add:hover {
        transform: translateY(-2px);
        color: white;
    }

    .rack-image {
        width: 90px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #E8EDF3;
    }

    .badge-zona {
        background: #EEF3FF;
        color: #3B5998;
        font-weight: 600;
        padding: 8px 12px;
        border-radius: 8px;
    }

    /* ACTION */
    .action-wrap {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        border: none;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: .2s;
        font-size: 12px;
    }

    .btn-edit {
        background: #FFF7E8;
        color: #F59E0B;
    }

    .btn-delete {
        background: #FFF1F2;
        color: #E11D48;
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }

    /* DATATABLE */

    .dataTables_wrapper{
        padding:20px;
    }

    .dataTables_filter{
        margin-bottom:14px;
    }

    .dataTables_filter input{
        border:1px solid #E2E8F0 !important;
        border-radius:12px !important;
        padding:8px 12px !important;
        background:white !important;
        font-size:13px !important;
    }

    /* FORCE PAGINATION STYLE */

    .dataTables_wrapper .pagination{
        gap:5px !important;
    }

    .dataTables_wrapper .page-item{
        margin:0 !important;
    }

    .dataTables_wrapper .page-link{
        min-width:40px !important;
        height:40px !important;
        display:flex !important;
        align-items:center !important;
        justify-content:center !important;

        border-radius:10px !important;
        border:1px solid #E2E8F0 !important;

        background:#F8FAFC !important;
        color:#64748B !important;

        box-shadow:none !important;
    }

    .dataTables_wrapper .page-link:hover{
        background:#BDD5F3 !important;
        color:#334155 !important;
        border-color:#DBE1EA !important;
    }

    .dataTables_wrapper .page-item.active .page-link{
        background:linear-gradient(135deg,#3B5998,#2C4A7C) !important;
        border:none !important;
        color:white !important;
    }

    .dataTables_wrapper .page-link:focus{
        box-shadow:none !important;
    }
</style>
@endpush

@section('content')

<!-- HEADER -->
<div class="page-header">
    <div class="page-title">
        <h3>Data Rak</h3>
    </div>

    <div class="header-actions">
        <a href="{{ route('admin.racks.create') }}" class="btn-modern btn-add text-decoration-none">
            <i class="fas fa-plus"></i>
            Tambah Rak
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm p-4" style="border-radius: 24px; background: white; border: 1px solid #EEF2F7;">
    <div class="table-responsive">
        <table class="table table-hover align-middle" id="racksTable" style="margin: 0 !important;">
            <thead class="table-light">
                <tr style="border-bottom: 2px solid #F1F5F9;">
                    <th width="60" style="color: #7B8794; font-size: 11px; text-transform: uppercase; font-weight: 700;">No</th>
                    <th style="color: #7B8794; font-size: 11px; text-transform: uppercase; font-weight: 700;">Nama Rak</th>
                    <th style="color: #7B8794; font-size: 11px; text-transform: uppercase; font-weight: 700;">Zona</th>
                    <th style="color: #7B8794; font-size: 11px; text-transform: uppercase; font-weight: 700;">Baris</th>
                    <th style="color: #7B8794; font-size: 11px; text-transform: uppercase; font-weight: 700;">Sekat</th>
                    <th style="color: #7B8794; font-size: 11px; text-transform: uppercase; font-weight: 700;">Dibuat</th>
                    <th width="150" style="color: #7B8794; font-size: 11px; text-transform: uppercase; font-weight: 700;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($racks as $rack)
                <tr style="border-color: #F1F5F9 !important;">
                    <td style="font-size: 13px;"><strong>{{ $loop->iteration }}</strong></td>
                    <td style="font-size: 13px;"><strong>{{ $rack->nama_rak }}</strong></td>
                    <td>
                        <span class="badge-zona" style="font-size: 11px;">
                            {{ $rack->zona }}
                        </span>
                    </td>
                    <td style="font-size: 13px;">{{ $rack->baris ?? '-' }}</td>
                    <td style="font-size: 13px;">
                        {{ $rack->sekat_mulai ?? '-' }}
                        -
                        {{ $rack->sekat_selesai ?? '-' }}
                    </td>
                    <td style="font-size: 13px;">{{ $rack->created_at?->format('d M Y') ?? '-' }}</td>
                    <td>
                        <div class="action-wrap">
                            <a href="{{ route('admin.racks.edit', $rack->id) }}" class="btn-action btn-edit text-decoration-none">
                                <i class="fas fa-pen"></i>
                            </a>

                            <form action="{{ route('admin.racks.destroy', $rack->id) }}" method="POST" onsubmit="return confirm('Hapus data rak ini?')" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button class="btn-action btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4" style="font-size: 13px;">
                        Data rak belum tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function(){
    $('#racksTable').DataTable({
        responsive: true,
        pageLength: 10,
        dom:
            "<'row align-items-center mb-3'<'col-md-6'l><'col-md-6'f>>" +
            "<'row'<'col-12'tr>>" +
            "<'row mt-3'<'col-md-6'i><'col-md-6'p>>",
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: {
                previous: "‹",
                next: "›"
            },
            zeroRecords: "Data tidak ditemukan"
        }
    });
});
</script>
@endpush