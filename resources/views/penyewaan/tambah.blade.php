<div class="modal fade" id="modalTambahPenyewaan" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="formTambahPenyewaan">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Penyewaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>ID Penyewaan</label>
                        <input type="text" name="id_penyewaan" class="form-control" value="{{ $kodePenyewaan }}"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label>User</label>
                        <select name="kode_user" class="form-control" required>
                            @foreach ($user as $us)
                                <option value="{{ $us->kode_user }}">{{ $us->nama_user }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Pelanggan</label>
                        <select name="id_pelanggan" class="form-control" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($pelanggan as $plg)
                                <option value="{{ $plg->id_pelanggan }}">{{ $plg->nama_pelanggan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Mobil</label>
                        <select name="id_mobil" class="form-control" required>
                            <option value="">-- Pilih Mobil --</option>
                            @foreach ($mobil as $mbl)
                                <option value="{{ $mbl->id_mobil }}">{{ $mbl->plat_nomor }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Sewa</label>
                        <input type="date" name="tanggal_sewa" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" class="form-control">
                    </div>



                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="berjalan">Berjalan</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    $('#formTambahPenyewaan').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{ url('penyewaan/simpan') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function () {
                alert('Data penyewaan berhasil disimpan');
                $('#modalTambahPenyewaan').modal('hide');
                location.reload();
            },
            error: function () {
                alert('Gagal menyimpan data');
            }
        });
    });
</script>