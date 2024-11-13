@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Agenda</h3>
        <div class="card-tools">
            <a href="{{ url('/agenda/export_pdf') }}" class="btn btn-sm btn-warning mt-1"><i class="fa fa-file-pdf"></i> Export Agenda (PDF)</a>
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
        <table class="table table-bordered table-striped table-hover table-sm" id="table_agenda">
            <thead>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Nama Tugas</th>
                    <th>Upload Berkas Agenda</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

{{-- @push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var dataAgenda;
        $(document).ready(function() {
            dataAgenda = $('#table_agenda').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ route('agenda.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                },
                columns: [
                    {
                        data: "kegiatan.judul_kegiatan",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "nama_tugas",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "upload_berkas",
                        className: "",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (data) {
                                return `<a href="{{ url('storage/agendas') }}/${data}" target="_blank" class="btn btn-sm btn-primary">Download</a>`;
                            }
                            return "No File";
                        }
                    }
                ]
            });
        });
    </script>
@endpush --}}
