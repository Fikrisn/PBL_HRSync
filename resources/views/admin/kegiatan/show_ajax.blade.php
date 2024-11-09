@empty($penjualan)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i>Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/penjualan') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Transaki Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info"></i> Data Transaksi Penjualan</h5>
                    Berikut adalah detail dari data transaksi penjualan
                </div>
                <table class="table table-sm table-bordered table-stripped">
                    <tr>
                        <th class="text-right col-3">Nama Kegiatan : </th>
                        <td class="col-9">{{ $penjualan->user->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Nama PIC Dosen : </th>
                        <td class="col-9">{{ $penjualan->pembeli }} </td>
                    </tr>
                    {{-- <tr>
                        <th class="text-right col-3">Kode Transaksi : </th>
                        <td class="col-9">{{ $penjualan->penjualan_kode }}</td>
                    </tr> --}}
                    <tr>
                        <th class="text-right col-3">Tanggal Kegiatan : </th>
                        <td class="col-9">{{ $penjualan->penjualan_tanggal }}</td>
                    </tr>
                </table>
                <table class="table table-sm table-bordered table-stripped">
                    <tr>
                        <th class="text-right">NO </th>
                        <th class="text-center">Nama Anggota </th>
                    </tr>
                    @foreach ($penjualan_detail as $item)
                    <tr>
                        <th class="text-right">  {{ $loop->iteration }} </th>

                        <td class="text-center">{{ $item->barang->barang_nama }} </td>
                    @endforeach
                </table>
                <div class="alert alert info">
                    <div class="card mb-3 blue">
                        <h5 class="modal-title" id="exampleModalLabel">Deskripsi Kegiatan</h5>
                    {{-- <p>{{ $penjualan->deskripsi_kegiatan }}</p> --}}
                    
                    <h5 class="modal-title" id="exampleModalLabel">Saran</h5>
                    {{-- <p>{{ $penjualan->saran }}</p> --}}
                    
                    <h5 class="modal-title" id="exampleModalLabel"> Dokumentasi</h5>
                    {{-- <p>{{ $penjualan->dokumentasi }}</p> --}}
                    {{-- <a href="{{ url($penjualan->dokumentasi) }}" target="_blank" class="btn btn-link">Verifikasi selesai</a> --}}
                </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Kembali</button>
            </div>
        </div>
    </div>
@endempty