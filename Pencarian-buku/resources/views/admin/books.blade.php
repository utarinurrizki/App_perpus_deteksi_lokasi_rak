@extends('admin.layout')

@section('title', 'Data Buku')

@push('styles')

<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

<link rel="stylesheet"
      href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<style>

    .cover-thumb{
        width:60px;
        height:80px;
        object-fit:cover;
        border-radius:6px;
    }

    .dt-buttons{
        margin-bottom:15px;
    }

</style>

@endpush



@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h4 class="mb-0">
        Data Buku
    </h4>


    <div class="d-flex gap-2">

        {{-- Tambah Buku --}}
        <a href="/admin/create"
           class="btn btn-primary btn-sm">

            <i class="fas fa-plus"></i>
            Tambah Data Buku

        </a>


        {{-- Import --}}
        <button class="btn btn-success btn-sm">

            <i class="fas fa-file-import"></i>
            Import Data Buku

        </button>

    </div>

</div>



<div class="card border-0 shadow-sm p-3">

    <div class="table-responsive">

        <table id="booksTable"
               class="table table-bordered align-middle">

            <thead class="table-light">

                <tr>

                    <th>No</th>
                    <th>Sampul</th>
                    <th>Judul</th>
                    <th>ISBN</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Kategori</th>
                    <th>Rak</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>

            </thead>


            <tbody>

                @foreach($books as $b)

                    <tr>

                        {{-- No --}}
                        <td>

                            {{ $loop->iteration }}

                        </td>



                        {{-- Cover --}}
                        <td>

                            @if($b->cover)

                                <img src="/images/cover/{{ $b->cover }}"
                                     class="cover-thumb">

                            @else

                                <span class="text-muted">

                                    -

                                </span>

                            @endif

                        </td>



                        {{-- Judul --}}
                        <td>

                            {{ $b->judul }}

                        </td>



                        {{-- ISBN --}}
                        <td>

                            {{ $b->isbn }}

                        </td>



                        {{-- Pengarang --}}
                        <td>

                            {{ $b->pengarang }}

                        </td>



                        {{-- Penerbit --}}
                        <td>

                            {{ $b->penerbit }}

                        </td>



                        {{-- Tahun --}}
                        <td>

                            {{ $b->tahun ?? '-' }}

                        </td>



                        {{-- Kategori --}}
                        <td>

                            {{ $b->kategori ?? '-' }}

                        </td>



                        {{-- Rak --}}
                        <td>

                            {{ optional($b->rack)->nama_rak ?? '-' }}

                        </td>



                        {{-- Status --}}
                        <td>

                            @if($b->jumlah_buku > 0)
                                <span class="badge bg-success">
                                    Tersedia
                                </span>

                            @else
                                <span class="badge bg-danger">
                                    Tidak Tersedia
                                </span>
                            @endif

                        </td>



                        {{-- Action --}}
                        <td>

                            <a href="/admin/{{ $b->id }}/edit"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>


                            <form action="/admin/{{ $b->id }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin hapus data?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">

                                    Hapus

                                </button>

                            </form>

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

    $('#booksTable').DataTable({

        dom:'Bfrtip',

        buttons:[

            {
                extend:'copy',
                exportOptions:{
                    columns:':not(:last-child)'
                }
            },

            {
                extend:'csv',
                exportOptions:{
                    columns:':not(:last-child)'
                }
            },

            {
                extend:'excel',
                exportOptions:{
                    columns:':not(:last-child)'
                }
            },

            {
                extend:'pdf',
                exportOptions:{
                    columns:':not(:last-child)'
                }
            },

            {
                extend:'print',
                exportOptions:{
                    columns:':not(:last-child)'
                }
            },

            'colvis'

        ],

        pageLength:10,

        language:{

            search:"Search:",

            lengthMenu:"Show _MENU_ entries",

            info:"Showing _START_ to _END_ of _TOTAL_ entries",

            paginate:{
                previous:"Prev",
                next:"Next"
            }

        }

    });

});

</script>

@endpush