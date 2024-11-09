@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Daftar Jenis Pengguna</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/jenis_pengguna/import') }}')" class="btn btn-sm btn-info mt-1">Import Jenis Pengguna</button>
                <a href="{{url('/jenis_pengguna/export_excel')}}" class="btn btn-sm btn-primary mt-1"><i class="fa fa-file-excel"></i> Export Jenis Pengguna (Excel)</a>
                <a href="{{url('/jenis_pengguna/export_pdf')}}" class="btn btn-sm btn-warning mt-1"><i class="fa fa-file-pdf"></i> Export Jenis Pengguna (PDF)</a>
                <button onclick="modalAction('{{ url('jenis_pengguna/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Jenis Pengguna</button>
            </div>
        </div>
        <div class="card-body">
            @if (@session('success'))
                <div class="alert alert-success">{{ session('success')}}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_jenis_pengguna">
                <thead>
                    <tr>
                        <th style="width: 5%; text-align: center;">ID</th>
                        <th style="width: 35%; text-align: center;">Nama Jenis Pengguna</th>
                        <th style="width: 30%; text-align: center;">Bobot</th>
                        <th style="width: 30%; text-align: center;">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"> </div>
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

        var dataJenisPengguna;
        $(document).ready(function() {
            var dataJenisPengguna = $('#table_jenis_pengguna').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ route('jenis_pengguna.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.id_jenis_pengguna = $('#id_jenis_pengguna').val();
                    },
                    "error": function(xhr, error, code) {
                        console.log(xhr.responseText); // Log the response for debugging
                        alert("Error occurred: " + xhr.status + " " + xhr.statusText); // Display error
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "nama_jenis_pengguna",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "bobot",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });
            $('#id_jenis_pengguna').on('change',function(){
                dataJenisPengguna.ajax.reload();
            })
        });
    </script>
@endpush