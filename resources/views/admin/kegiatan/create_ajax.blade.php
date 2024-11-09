<form action="{{ url('/kegiatan/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kegiatan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Judul Kegiatan</label>
                    <input value="" type="text" name="judul_kegiatan" id="judul_kegiatan" class="form-control" required>
                    <small id="error-judul_kegiatan" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Deskripsi Kegiatan</label>
                    <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" class="form-control" required></textarea>
                    <small id="error-deskripsi_kegiatan" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input value="" type="datetime-local" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
                    <small id="error-tanggal_mulai" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Tanggal Selesai</label>
                    <input value="" type="datetime-local" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required>
                    <small id="error-tanggal_selesai" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Jenis Kegiatan</label>
                    <select name="id_jenis_kegiatan" id="id_jenis_kegiatan" class="form-control" required>
                        <option value="">- Pilih Jenis Kegiatan -</option>
                        @foreach ($jenis_kegiatan as $item)
                            <option value="{{ $item->id_jenis_kegiatan }}">{{ $item->nama_jenis_kegiatan }}</option>
                        @endforeach
                    </select>
                    <small id="error-id_jenis_kegiatan" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>PIC</label>
                    <select name="pic_id" id="pic_id" class="form-control" required>
                        <option value="">- Pilih PIC -</option>
                        @foreach ($pengguna as $item)
                            <option value="{{ $item->id_pengguna }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-pic_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Anggota 1</label>
                    <select name="anggota_id[]" id="anggota_id_1" class="form-control" required>
                        <option value="">- Pilih Anggota -</option>
                        @foreach ($pengguna as $item)
                            <option value="{{ $item->id_pengguna }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-anggota_id_1" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Anggota 2</label>
                    <select name="anggota_id[]" id="anggota_id_2" class="form-control" required>
                        <option value="">- Pilih Anggota -</option>
                        @foreach ($pengguna as $item)
                            <option value="{{ $item->id_pengguna }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-anggota_id_2" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Anggota 3</label>
                    <select name="anggota_id[]" id="anggota_id_3" class="form-control" required>
                        <option value="">- Pilih Anggota -</option>
                        @foreach ($pengguna as $item)
                            <option value="{{ $item->id_pengguna }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-anggota_id_3" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Anggota 4</label>
                    <select name="anggota_id[]" id="anggota_id_4" class="form-control" required>
                        <option value="">- Pilih Anggota -</option>
                        @foreach ($pengguna as $item)
                            <option value="{{ $item->id_pengguna }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-anggota_id_4" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Anggota 5</label>
                    <select name="anggota_id[]" id="anggota_id_5" class="form-control" required>
                        <option value="">- Pilih Anggota -</option>
                        @foreach ($pengguna as $item)
                            <option value="{{ $item->id_pengguna }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-anggota_id_5" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Anggota 6</label>
                    <select name="anggota_id[]" id="anggota_id_6" class="form-control" required>
                        <option value="">- Pilih Anggota -</option>
                        @foreach ($pengguna as $item)
                            <option value="{{ $item->id_pengguna }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-anggota_id_6" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

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
        $("#form-tambah").validate({
            rules: {
                judul_kegiatan: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                deskripsi_kegiatan: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                tanggal_mulai: {
                    required: true,
                    date: true
                },
                tanggal_selesai: {
                    required: true,
                    date: true
                },
                id_jenis_kegiatan: {
                    required: true,
                    number: true
                },
                pic_id: {
                    required: true,
                    number: true
                },
                anggota_id[]: {
                    required: true,
                    minlength: 1,
                    maxlength: 6
                }
            },
            submitHandler: function(form) {
                var formData = new FormData(form); // Convert form to FormData to handle file
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: formData, // Data sent as FormData
                    processData: false, // Set processData and contentType to false to handle file
                    contentType: false,
                    success: function(response) {
                        if (response.status) { // If success
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataKegiatan.ajax.reload(); // Reload datatable
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