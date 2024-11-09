@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ $breadcrumb->title }}</h3>
                <div class="card-tools">
                    <a href="{{ url('statistik/export_pdf') }}" class="btn btn-sm btn-warning mt-1"><i class="fa fa-file-pdf"></i> Export PDF</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover table-sm" id="table_statistik">
                    <thead>
                        <tr>
                            <th>ID Statistik</th>
                            <th>Kegiatan</th>
                            <th>Jenis Pengguna</th>
                            <th>Pengguna</th>
                            <th>Saran</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        @foreach ($statistik as $data)
                            <tr>
                                <td>{{ $data->id_statistik }}</td>
                                <td>{{ $data->id_kegiatan }}</td>
                                <td>{{ $data->jenis_pengguna }}</td>
                                <td>{{ $data->pengguna }}</td>
                                <td>{{ $data->saran }}</td>
                            </tr>
                        @endforeach
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table_statistik').DataTable({
                responsive: true,
                autoWidth: false,
            });
        });
    </script>
@endpush