@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Daftar Kegiatan</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/kegiatan/import') }}')" class="btn btn-sm btn-info mt-1">Import Kegiatan</button>
                <a href="{{url('/kegiatan/export_excel')}}" class="btn btn-sm btn-primary mt-1"><i class="fa fa-file-excel"></i> Export Kegiatan (Excel)</a>
                <a href="{{url('/kegiatan/export_pdf')}}" class="btn btn-sm btn-warning mt-1"><i class="fa fa-file-pdf"></i> Export Kegiatan (PDF)</a>
                <button onclick="modalAction('{{ url('kegiatan/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
            </div>
        </div>
        <div class="card-body">
            @if (@session('success'))
                <div class="alert alert-success">{{ session('success')}}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_kegiatan">
                <thead>
                    <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 15%;">Judul Kegiatan</th>
                        <th style="width: 20%;">Deskripsi</th>
                        <th style="width: 10%;">Tanggal Mulai</th>
                        <th style="width: 10%;">Tanggal Selesai</th>
                        <th style="width: 10%;">Jenis Kegiatan</th>
                        <th style="width: 10%;">PIC</th>
                        <th style="width: 10%;">Anggota</th>
                        <th style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection
@push('css')
@endpush
@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var dataKegiatan;
        $(document).ready(function() {
            dataKegiatan = $('#table_kegiatan').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ route('kegiatan.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.id_jenis_kegiatan = $('#id_jenis_kegiatan').val();
                    }
                },
                columns: [
                    {
                        data: "id_kegiatan",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "judul_kegiatan",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "deskripsi_kegiatan",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "tanggal_mulai",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "tanggal_selesai",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "nama_jenis_kegiatan",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "pic",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "anggota",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#id_jenis_kegiatan').on('change', function() {
                dataKegiatan.ajax.reload();
            });
        });
    </script>
@endpush