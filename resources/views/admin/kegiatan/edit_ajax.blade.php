@empty($kegiatan)
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
                <a href="{{ url('/kegiatan') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/kegiatan/' . $kegiatan->id_kegiatan . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul Kegiatan</label>
                        <input value="{{ $kegiatan->judul_kegiatan }}" type="text" name="judul_kegiatan" id="judul_kegiatan" class="form-control" required>
                        <small id="error-judul_kegiatan" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Kegiatan</label>
                        <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" class="form-control" required>{{ $kegiatan->deskripsi_kegiatan }}</textarea>
                        <small id="error-deskripsi_kegiatan" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input value="{{ $kegiatan->tanggal_mulai }}" type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
                        <small id="error-tanggal_mulai" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input value="{{ $kegiatan->tanggal_selesai }}" type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required>
                        <small id="error-tanggal_selesai" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kegiatan</label>
                        <select name="id_jenis_kegiatan" id="id_jenis_kegiatan" class="form-control" required>
                            <option value="">- Pilih Jenis Kegiatan -</option>
                            @foreach ($jenis_kegiatan as $item)
                                <option value="{{ $item->id_jenis_kegiatan }}" {{ $kegiatan->id_jenis_kegiatan == $item->id_jenis_kegiatan ? 'selected' : '' }}>{{ $item->nama_jenis_kegiatan }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_jenis_kegiatan" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>PIC</label>
                        <select name="pic_id" id="pic_id" class="form-control" required>
                            <option value="">- Pilih PIC -</option>
                            @foreach ($pic as $item)
                                <option value="{{ $item->id }}" {{ $kegiatan->pic_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-pic_id" class="error-text form-text text-danger"></small>
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