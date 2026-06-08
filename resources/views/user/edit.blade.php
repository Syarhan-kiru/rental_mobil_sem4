<div class="modal fade" id="modalEditUser" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="formEditUser">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Kode User</label>
                        <input type="text" name="kode_user" class="form-control" value="{{ $user->kode_user }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Nama User</label>
                        <input type="text" name="nama_user" id="nama_user_edit" class="form-control" value="{{ $user->nama_user }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email_user" class="form-control" value="{{ $user->email_user }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Password Baru</label>
                        <input type="password" name="pass_user" class="form-control" placeholder="Kosongkan jika tidak diubah">
                    </div>

                    <div class="mb-3">
                        <label>Level</label>
                        <select name="level_user" class="form-control" required>
                            <option value="1" {{ $user->level_user == 1 ? 'selected' : '' }}>MANAJER</option>
                            <option value="2" {{ $user->level_user == 2 ? 'selected' : '' }}>ADMIN</option>
                            <option value="3" {{ $user->level_user == 3 ? 'selected' : '' }}>KARYAWAN</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    $('#formEditUser').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ url('user/update') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                alert(response.message);
                $('#modalEditUser').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                alert(xhr.responseJSON?.message || 'Gagal memperbarui data');
            }
        });
    });
</script>
