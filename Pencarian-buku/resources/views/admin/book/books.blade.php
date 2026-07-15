@extends('admin.layout')

@section('title', 'Data Buku')

@push('styles')

<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<link rel="stylesheet"
      href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<style>

    .page-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        flex-wrap:wrap;
        gap:20px;
        margin-bottom:24px;
    }

    .page-title h3{
        margin:0;
        font-size:26px;
        font-weight:800;
        color:#1E293B;
    }

    .page-title p{
        margin:5px 0 0;
        color:#7B8794;
        font-size:13px;
    }

    .header-actions{
        display:flex;
        gap:10px;
        flex-wrap:wrap;
    }

    .btn-modern{
        border:none;
        border-radius:14px;
        padding:10px 16px;
        font-weight:600;
        font-size:13px;
        transition:.25s;
        display:flex;
        align-items:center;
        gap:8px;
    }

    .btn-add{
        background:linear-gradient(135deg,#3B5998,#2C4A7C);
        color:white;
        box-shadow:0 10px 25px rgba(59,89,152,.20);
    }

    .btn-add:hover{
        transform:translateY(-2px);
        color:white;
    }

    .btn-import{
        background:white;
        border:1px solid #E5EAF2;
        color:#243041;
    }

    .btn-import:hover{
        background:#F8FAFC;
    }

    /* CARD */

    .books-card{
        background:white;
        border-radius:24px;
        overflow:hidden;
        box-shadow:0 10px 35px rgba(15,23,42,.05);
        border:1px solid #EEF2F7;
    }

    .books-card-header{
        padding:22px 24px;
        border-bottom:1px solid #EEF2F7;
        display:flex;
        justify-content:space-between;
        align-items:center;
        flex-wrap:wrap;
        gap:15px;
    }

    .books-card-header h5{
        margin:0;
        font-size:18px;
        font-weight:700;
        color:#243041;
    }

    .books-card-header p{
        margin:4px 0 0;
        color:#7B8794;
        font-size:13px;
    }

    /* TABLE */

    .table-modern{
        margin:0 !important;
    }

    .table-modern thead th{
        background:#F8FAFC !important;
        border:none !important;
        color:#7B8794 !important;
        font-size:11px;
        text-transform:uppercase;
        letter-spacing:.4px;
        font-weight:700;
        padding:14px 12px !important;
        white-space:nowrap;
    }

    .table-modern tbody td{
        padding:14px 12px !important;
        vertical-align:middle;
        border-color:#F1F5F9 !important;
        font-size:13px;
        white-space:nowrap;
    }

    .table-modern tbody tr{
        transition:.2s;
    }

    .table-modern tbody tr:hover{
        background:#FAFBFD;
    }

    /* COVER */

    .cover-box{
        width:55px;
        height:75px;
        border-radius:14px;
        overflow:hidden;
        background:#F8FAFC;
        border:1px solid #EEF2F7;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .cover-thumb{
        width:100%;
        height:100%;
        object-fit:cover;
    }

    .no-cover{
        font-size:10px;
        color:#94A3B8;
        text-align:center;
        padding:5px;
    }

    /* BOOK INFO */

    .book-title{
        font-weight:700;
        font-size:13px;
        color:#1E293B;
        margin-bottom:3px;
        max-width:220px;
        white-space:normal;
    }

    .book-sub{
        font-size:11px;
        color:#7B8794;
    }

    .badge-category{
        background:#EEF3FF;
        color:#3B5998;
        padding:6px 10px;
        border-radius:999px;
        font-size:11px;
        font-weight:600;
    }

    .badge-rack{
        background:#ECFDF3;
        color:#027A48;
        padding:6px 10px;
        border-radius:999px;
        font-size:11px;
        font-weight:600;
    }

    .status-available{
        background:#ECFDF3;
        color:#027A48;
        padding:7px 12px;
        border-radius:999px;
        font-size:11px;
        font-weight:700;
    }

    .status-empty{
        background:#FEF3F2;
        color:#B42318;
        padding:7px 12px;
        border-radius:999px;
        font-size:11px;
        font-weight:700;
    }

    /* ACTION */

    .action-wrap{
        display:flex;
        gap:8px;
    }

    .btn-action{
        border:none;
        width:34px;
        height:34px;
        border-radius:10px;
        display:flex;
        align-items:center;
        justify-content:center;
        transition:.2s;
        font-size:12px;
    }

    .btn-edit{
        background:#FFF7E8;
        color:#F59E0B;
    }

    .btn-delete{
        background:#FFF1F2;
        color:#E11D48;
    }

    .btn-view{
        background:#EEF3FF;
        color:#3B5998;
    }   

    .btn-action:hover{
        transform:translateY(-2px);
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

    .dataTables_length{
        margin-bottom:14px;
    }

    .dataTables_length select{
        border-radius:10px !important;
        border:1px solid #E2E8F0 !important;
        padding:4px 10px !important;
        font-size:13px !important;
    }

    .dt-buttons{
        margin-bottom:16px;
        display:flex;
        gap:8px;
        flex-wrap:wrap;
    }

    .dt-button{
        border:none !important;
        background:#EEF3FF !important;
        color:#3B5998 !important;
        border-radius:10px !important;
        padding:8px 14px !important;
        font-weight:600 !important;
        font-size:12px !important;
    }

    /* Pagination */

    .dataTables_wrapper .dataTables_paginate .paginate_button{
        background:#f8fafc !important;
        color:#64748b !important;
        border:1px solid #e2e8f0 !important;
        border-radius:8px !important;
        box-shadow:none !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
        background:#bdd5f3 !important;
        color:#334155 !important;
        border:1px solid #dbe1ea !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{
        background:linear-gradient(135deg,#3B5998,#2C4A7C) !important;
        border:none !important;
        border-radius:10px !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:focus{
        box-shadow:none !important;
        outline:none !important;
    }

    .table-responsive{
        overflow-x:auto;
    }

    #booksTable{
        width:100% !important;
        min-width:1400px;
    }

</style>

@endpush

@section('content')

<!-- HEADER -->

<div class="page-header">

    <div class="page-title">
        <h3>Data Buku</h3>
    </div>

    <div class="header-actions">

        <a href="{{ route('admin.books.create') }}"
           class="btn-modern btn-add text-decoration-none">

            <i class="fas fa-plus"></i>
            Tambah Buku

        </a>

        <!-- <button class="btn-modern btn-import">

            <i class="fas fa-file-import"></i>
            Import Buku

        </button> -->

    </div>

</div>

<!-- CARD -->

<div class="books-card">

    <div class="books-card-header">

        <div>

            <h5>Daftar Koleksi Buku</h5>

            <p>
                Seluruh data buku yang tersedia pada sistem perpustakaan.
            </p>

        </div>

    </div>

    <div class="table-responsive">

        <table id="booksTable"
               class="table table-modern align-middle">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Sampul</th>
                    <th>Buku</th>
                    <th>ISBN</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Kategori</th>
                    <th>Rak</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @foreach($books as $b)

                    <tr>

                        <!-- NO -->

                        <td>
                            <strong>{{ $loop->iteration }}</strong>
                        </td>

                        <!-- COVER -->

                        <td>

                            <div class="cover-box">

                                @if($b->cover)

                                    <img src="/images/cover/{{ $b->cover }}"
                                         class="cover-thumb">

                                @else

                                    <div class="no-cover">
                                        No Cover
                                    </div>

                                @endif

                            </div>

                        </td>

                        <!-- BOOK -->

                        <td>

                            <div class="book-title">
                                {{ $b->judul }}
                            </div>

                            <div class="book-sub">
                                {{ $b->pengarang }}
                            </div>

                        </td>

                        <!-- ISBN -->

                        <td>
                            {{ $b->isbn }}
                        </td>

                        <!-- PENERBIT -->

                        <td>
                            {{ $b->penerbit }}
                        </td>

                        <!-- TAHUN -->

                        <td>
                            {{ $b->tahun ?? '-' }}
                        </td>

                        <!-- KATEGORI -->

                        <td>

                            @if($b->kategori)

                                <span class="badge-category">
                                    {{ $b->kategori }}
                                </span>

                            @else

                                <span class="text-muted">-</span>

                            @endif

                        </td>

                        <!-- RAK -->

                        <td>

                            <span class="badge-rack">

                                <i class="fas fa-layer-group me-1"></i>

                                {{ optional($b->rack)->nama_rak ?? '-' }}

                            </span>

                        </td>

                        <!-- STATUS -->

                        <td>

                            @if($b->jumlah_buku > 0)

                                <span class="status-available">
                                    Tersedia
                                </span>

                            @else

                                <span class="status-empty">
                                    Tidak Tersedia
                                </span>

                            @endif

                        </td>

                        <!-- ACTION -->

                        <td>

                            <div class="action-wrap">

                                <a href="/admin/books/{{ $b->id }}"
                                    class="btn-action btn-view text-decoration-none">
                                     <i class="fas fa-eye"></i>
                                 </a>

                                <a href="{{ route('admin.books.edit', $b->id) }}"
                                   class="btn-action btn-edit text-decoration-none">

                                    <i class="fas fa-pen"></i>

                                </a>

                                <form action="{{ route('admin.books.destroy', $b->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus data?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn-action btn-delete">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>

$(document).ready(function(){

    var table = $('#booksTable').DataTable({

        scrollX:true,
        autoWidth:false,

        dom:
            "<'row align-items-center mb-3'<'col-md-6'l><'col-md-6'f>>" +
            "<'row mb-3'<'col-12'B>>" +
            "<'row'<'col-12'tr>>" +
            "<'row mt-3'<'col-md-6'i><'col-md-6'p>>",

        buttons:[

            {
                extend:'copy',
                text:'Copy'
            },

            {
                extend:'excel',
                text:'Excel'
            },

            {
                extend:'pdf',
                text:'PDF'
            },

            {
                extend:'print',
                text:'Print'
            },

            {
                extend:'colvis',
                text:'Kolom'
            }

        ],

        pageLength: parseInt(localStorage.getItem('booksTableLength')) || 10,

        lengthMenu:[
            [10,25,50,100,-1],
            [10,25,50,100,"Semua"]
        ],

        language:{

            search:"Search:",

            lengthMenu:"Show _MENU_ entries",

            info:"Showing _START_ to _END_ of _TOTAL_ entries",

            paginate:{
                previous:"‹",
                next:"›"
            }

        }

    });
    // Simpan pilihan Show Entries
    table.on('length.dt', function (e, settings, len) {
        localStorage.setItem('booksTableLength', len);
    });
});

</script>

@endpush