<div class="modal fade" id="modalTambahUser" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="formTambahUser">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Kode User</label>
                        <input type="text" name="kode_user" class="form-control" value="{{ old('kode_user') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Nama User</label>
                        <input type="text" name="nama_user" class="form-control"value="{{ old('nama_user') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email_user" class="form-control" value="{{ old('email_user') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="pass_user" class="form-control" value="{{ old('pass_user') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Level</label>
                        <select name="level_user" class="form-control" required>
                            <option value="">-- Pilih Level --</option>
                            <option value="1">MANAJER</option>
                            <option value="2">ADMIN</option>
                            <option value="3">KARYAWAN</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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
    $('#formTambahUser').submit(function(e) {
    e.preventDefault();

    $.ajax({
        url: "{{ url('user/simpan') }}",
        type: "POST",
        data: $(this).serialize(),
        success: function(response) {
            alert(response.message);
            location.reload();
        },
        error: function(xhr) {
            alert('Gagal menyimpan data');
        }
    });
});
</script>