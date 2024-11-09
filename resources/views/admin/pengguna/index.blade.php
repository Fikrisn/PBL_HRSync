@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Pengguna</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/pengguna/import') }}')" class="btn btn-sm btn-info mt-1">Import Pengguna</button>
            <a href="{{ url('/pengguna/export_excel') }}" class="btn btn-sm btn-primary mt-1"><i class="fa fa-file-excel"></i> Export Pengguna (Excel)</a>
            <a href="{{ url('/pengguna/export_pdf') }}" class="btn btn-sm btn-warning mt-1"><i class="fa fa-file-pdf"></i> Export Pengguna (PDF)</a>
            <button onclick="modalAction('{{ url('pengguna/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="id_jenis_pengguna" name="id_jenis_pengguna" required>
                            <option value="">- Semua -</option>
                            @foreach ($jenis_pengguna as $item)
                                <option value="{{ $item->id_jenis_pengguna }}">{{ $item->nama_jenis_pengguna }}</option>
                            @endforeach
                        </select>
                    </div>
                    <small class="form-text text-muted">Jenis Pengguna</small>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
            <thead>
                <tr>
                    <th>ID Pengguna</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>NIP</th>
                    <th>Jenis Pengguna</th>
                    <th>Aksi</th>
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

        var dataUser;
        $(document).ready(function() {
            dataUser = $('#table_user').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ route('pengguna.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.id_jenis_pengguna = $('#id_jenis_pengguna').val();
                    }
                },
                columns: [
                    {
                        data: "id_pengguna",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "email",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "NIP",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jenispengguna.nama_jenis_pengguna",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#id_jenis_pengguna').on('change', function() {
                dataUser.ajax.reload();
            });
        });
    </script>
@endpush