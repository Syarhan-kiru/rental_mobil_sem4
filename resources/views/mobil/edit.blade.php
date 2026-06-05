<div class="modal fade" id="modalEditMobil" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="formEditMobil" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Edit Mobil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Kode Mobil</label>
                        <input type="text" name="id_mobil" class="form-control"
                            value="{{ $mobil->id_mobil }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Plat Nomor</label>
                        <input type="text" name="plat_nomor" class="form-control" value="{{ $mobil->plat_nomor }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Merek</label>
                        <input type="text" name="merek" class="form-control" value="{{ $mobil->merek }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Tipe</label>
                        <input type="text" name="tipe" class="form-control" value="{{ $mobil->tipe }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Tahun</label>
                        <input type="number" name="tahun" class="form-control" value="{{ $mobil->tahun }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Harga Sewa/Hari</label>
                        <input type="number" name="harga_sewa_sehari" class="form-control" value="{{ $mobil->harga_sewa_sehari }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Foto Mobil</label>
                        <input type="file" name="foto" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                            <option value="service">Service</option>
                            <option value="disewa">Disewa</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    $('#formEditMobil').submit(function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "{{ url('mobil/update') }}",
        type: "POST",
        data: formData,

        processData: false,
        contentType: false,

        success: function(response) {

            alert(response.message);

            $('#modalTambahMobil').modal('hide');

            location.reload();
        },

        error: function(xhr) {

            console.log(xhr.responseText);

            alert('Gagal menyimpan data');
        }
    });
});
</script>