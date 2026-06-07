<div class="modal fade" id="modalEditPelanggan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="formEditPelanggan" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Edit Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Kode Pelanggan</label>
                        <input type="text" name="id_pelanggan" class="form-control"
                            value="{{ $pelanggan->id_pelanggan }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" class="form-control"
                            value="{{ $pelanggan->nama_pelanggan }}" required>
                    </div>

                    <div class="mb-3">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control"
                            value="{{ $pelanggan->nik }}" required>
                    </div>

                    <div class="mb-3">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control"
                            value="{{ $pelanggan->no_hp }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{ $pelanggan->alamat }}</textarea>
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
    $('#formEditPelanggan').submit(function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "{{ url('pelanggan/update') }}",
        type: "POST",
        data: formData,

        processData: false,
        contentType: false,

        success: function(response) {

            alert(response.message);

            $('#modalEditPelanggan').modal('hide');

            location.reload();
        },

        error: function(xhr) {

            console.log(xhr.responseText);

            alert('Gagal menyimpan data');
        }
    });
});

</script>
