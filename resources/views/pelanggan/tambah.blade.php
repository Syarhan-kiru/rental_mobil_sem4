<div class="modal fade" id="modalTambahPelanggan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="formTambahPelanggan">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>ID Pelanggan</label>
                        <input type="text" name="id_pelanggan"
                               class="form-control" value="{{ $kodePelanggan }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control"
                                  rows="3" required></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    $('#formTambahPelanggan').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ url('pelanggan/simpan') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function() {
                alert('Data pelanggan berhasil disimpan');
                $('#modalTambahPelanggan').modal('hide');
                location.reload();
            },
            error: function() {
                alert('Gagal menyimpan data');
            }
        });
    });
</script>