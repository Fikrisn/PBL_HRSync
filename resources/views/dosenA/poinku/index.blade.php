@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ $breadcrumb->title }}</h3>
                <div class="card-tools">
                    <a href="{{ url('poinku/export_pdf') }}" class="btn btn-sm btn-warning mt-1"><i class="fa fa-file-pdf"></i> Export PDF</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover table-sm" id="table_poin_dosen">
                    <thead>
                        <tr>
                            <th>Nama Kegiatan</th>
                            <th>Peran</th>
                            <th>Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($poinDosen as $poin)
                            <tr>
                                <td>{{ $poin->judul_kegiatan }}</td>
                                <td>{{ $poin->nama }}</td>
                                <td>{{ $poin->poin }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection