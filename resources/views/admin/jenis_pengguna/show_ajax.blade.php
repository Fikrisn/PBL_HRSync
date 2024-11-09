<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="exampleModalLabel">Detail Jenis Pengguna</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @empty($jenis_pengguna)
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/jenis_pengguna') }}" class="btn btn-warning">Kembali</a>
            @else
                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th class="text-right col-3">ID :</th>
                        <td class="col-9">{{ $jenis_pengguna->id_jenis_pengguna }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Kode :</th>
                        <td class="col-9">{{ $jenis_pengguna->jenis_kode }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Nama Jenis Pengguna :</th>
                        <td class="col-9">{{ $jenis_pengguna->nama_jenis_pengguna }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Bobot :</th>
                        <td class="col-9">{{ $jenis_pengguna->bobot }}</td>
                    </tr>
                </table>
            @endempty
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>

<style>
    .modal-header.bg-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
    }
    .modal-header .close {
        color: #fff;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .table th {
        background-color: #f8f9fa;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 123, 255, 0.05);
    }
</style>

<script>
    $(document).ready(function() {
        $('#modal-master').on('show.bs.modal', function() {
            // Custom actions when the modal is shown
        });

        $('#modal-master').on('hide.bs.modal', function() {
            // Custom actions when the modal is hidden
        });
    });
</script>