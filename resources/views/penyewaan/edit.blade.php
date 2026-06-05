<div class="modal fade" id="modalEditPenyewaan" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="formEditPenyewaan">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Edit Penyewaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>ID Penyewaan</label>
                        <input type="text" name="id_penyewaan" class="form-control"
                            value="{{ $penyewaan->id_penyewaan }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label>User</label>
                        <select name="kode_user" class="form-control" required>
                            @foreach ($user as $us)
                                <option value="{{ $us->kode_user }}"
                                    {{ $penyewaan->kode_user == $us->kode_user ? 'selected' : '' }}>
                                    {{ $us->nama_user ?? $us->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Pelanggan</label>
                        <select name="id_pelanggan" class="form-control" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($pelanggan as $plg)
                                <option value="{{ $plg->id_pelanggan }}"
                                    {{ $penyewaan->id_pelanggan == $plg->id_pelanggan ? 'selected' : '' }}>
                                    {{ $plg->nama_pelanggan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Mobil</label>
                        <select name="id_mobil" id="id_mobil_edit" class="form-control" required>
                            <option value="">-- Pilih Mobil --</option>
                            @foreach ($mobil as $mbl)
                                <option value="{{ $mbl->id_mobil }}"
                                    data-harga="{{ $mbl->harga_sewa_sehari }}"
                                    {{ $penyewaan->id_mobil == $mbl->id_mobil ? 'selected' : '' }}>
                                    {{ $mbl->plat_nomor }} - {{ $mbl->merek }} {{ $mbl->tipe }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Sewa</label>
                        <input type="date" name="tanggal_sewa" id="tanggal_sewa_edit" class="form-control"
                            value="{{ $penyewaan->tanggal_sewa }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali_edit" class="form-control"
                            value="{{ $penyewaan->tanggal_kembali }}">
                    </div>

                    <div class="mb-3">
                        <label>Total Harga</label>
                        <input type="number" name="total_harga" id="total_harga_edit" class="form-control"
                            value="{{ $penyewaan->total_harga }}" readonly required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="berjalan" {{ $penyewaan->status == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                            <option value="selesai" {{ $penyewaan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
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
    function hitungTotalHargaEdit() {
        const mobilTerpilih = $('#id_mobil_edit option:selected');
        const hargaPerHari = parseInt(mobilTerpilih.data('harga'), 10) || 0;
        const tanggalSewa = $('#tanggal_sewa_edit').val();
        const tanggalKembali = $('#tanggal_kembali_edit').val();

        if (!hargaPerHari || !tanggalSewa || !tanggalKembali) {
            return;
        }

        const tglSewa = new Date(tanggalSewa);
        const tglKembali = new Date(tanggalKembali);
        const selisihMs = tglKembali - tglSewa;
        let jumlahHari = Math.ceil(selisihMs / (1000 * 60 * 60 * 24));

        if (jumlahHari <= 0) {
            jumlahHari = 1;
        }

        $('#total_harga_edit').val(hargaPerHari * jumlahHari);
    }

    $('#id_mobil_edit, #tanggal_sewa_edit, #tanggal_kembali_edit').on('change', function () {
        hitungTotalHargaEdit();
    });

    $('#formEditPenyewaan').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{ url('penyewaan/update/' . $penyewaan->id_penyewaan) }}",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                alert(response.message);
                $('#modalEditPenyewaan').modal('hide');
                location.reload();
            },
            error: function () {
                alert('Gagal memperbarui data');
            }
        });
    });
</script>
