@empty($jenis_pengguna)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/jenis_pengguna') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/jenis_pengguna/' .$jenis_pengguna->id_jenis_pengguna. '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Pengguna</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode</label>
                        <input value="{{ $jenis_pengguna->jenis_kode }}" type="text" name="jenis_kode" id="jenis_kode"
                            class="form-control" required>
                        <small id="error-jenis_kode" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input value="{{ $jenis_pengguna->nama_jenis_pengguna }}" type="text" name="nama_jenis_pengguna" id="nama_jenis_pengguna" class="form-control"
                            required>
                        <small id="error-nama_jenis_pengguna" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Bobot</label>
                        <input value="{{ $jenis_pengguna->bobot }}" type="number" name="bobot" id="bobot" class="form-control" required>
                        <small id="error-bobot" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
@endempty

<style>
    .modal-header.bg-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
    }
    .modal-header .close {
        color: #fff;
    }
    .form-group label {
        font-weight: bold;
    }
    .form-control {
        border-radius: 0.25rem;
    }
    .error-text {
        font-size: 0.875rem;
    }
</style>

<script>
    $(document).ready(function() {
        $("#form-edit").validate({
            rules: {
                jenis_kode: {
                    required: true,
                    minlength: 3,
                    maxlength: 3
                },
                nama_jenis_pengguna: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                bobot: {
                    required: true,
                    number: true,
                    min: 1
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) { // If success
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataUser.ajax.reload(); // Reload datatable
                        } else { // If error
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal mengirim data. Silakan coba lagi.'
                        });
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>