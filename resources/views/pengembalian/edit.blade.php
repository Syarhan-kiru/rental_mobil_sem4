<div class="modal fade" id="modalEditPengembalian" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="formEditPengembalian">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Edit Pengembalian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>ID Pengembalian</label>
                        <input type="text" name="id_pengembalian" class="form-control" value="{{ $pengembalian->id_pengembalian }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Transaksi Penyewaan</label>
                        <select name="id_penyewaan" id="id_penyewaan_edit" class="form-control" required>
                            @foreach ($penyewaan as $sewa)
                                <option value="{{ $sewa->id_penyewaan }}"
                                    data-totalharga="{{ $sewa->total_harga }}"
                                    data-tglkembali="{{ $sewa->tanggal_kembali }}"
                                    {{ $pengembalian->id_penyewaan == $sewa->id_penyewaan ? 'selected' : '' }}>
                                    {{ $sewa->id_penyewaan }} - {{ $sewa->pelanggan->nama_pelanggan }} ({{ $sewa->mobil->merek }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Dikembalikan (Aktual)</label>
                        <input type="date" name="tanggal_dikembalikan" id="tanggal_dikembalikan_edit" class="form-control" value="{{ $pengembalian->tanggal_dikembalikan }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Kondisi Mobil</label>
                        <select name="kondisi_mobil" id="kondisi_mobil_edit" class="form-control" required>
                            <option value="Baik" {{ $pengembalian->kondisi_mobil == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ $pengembalian->kondisi_mobil == 'Rusak Ringan' ? 'selected' : '' }}>Lecet</option>
                            <option value="Rusak Berat" {{ $pengembalian->kondisi_mobil == 'Rusak Berat' ? 'selected' : '' }}>Rusak</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Denda Terlambat/Kerusakan (Rp)</label>
                        <input type="number" name="denda" id="denda_edit" class="form-control" value="{{ $pengembalian->denda }}" readonly required>
                    </div>

                    <div class="mb-3">
                        <label>Total Bayar Akhir (Rp)</label>
                        <input type="number" name="total_bayar" id="total_bayar_edit" class="form-control" value="{{ $pengembalian->total_bayar }}" readonly required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    function hitungTotalPengembalianEdit() {
        const sewaTerpilih = $('#id_penyewaan_edit option:selected');
        if (!sewaTerpilih.val()) return;

        const totalHargaSewa = parseInt(sewaTerpilih.data('totalharga'), 10) || 0;
        const tglHarusKembali = new Date(sewaTerpilih.data('tglkembali'));
        const tglKembaliAktual = new Date($('#tanggal_dikembalikan_edit').val());

        let dendaKeterlambatan = 0;
        if ($('#tanggal_dikembalikan_edit').val() && tglKembaliAktual > tglHarusKembali) {
            const selisihWaktu = tglKembaliAktual - tglHarusKembali;
            const selisihHari = Math.ceil(selisihWaktu / (1000 * 60 * 60 * 24));
            dendaKeterlambatan = selisihHari * 50000;
        }

        let dendaKerusakan = 0;
        const kondisi = $('#kondisi_mobil_edit').val();
        if (kondisi === 'Rusak Ringan') dendaKerusakan = 200000;
        if (kondisi === 'Rusak Berat') dendaKerusakan = 1000000;

        const denda = dendaKeterlambatan + dendaKerusakan;
        $('#denda_edit').val(denda);

        $('#total_bayar_edit').val(totalHargaSewa + denda);
    }

    $('#id_penyewaan_edit, #tanggal_dikembalikan_edit, #kondisi_mobil_edit').on('change input', function () {
        hitungTotalPengembalianEdit();
    });

    hitungTotalPengembalianEdit();

    $('#formEditPengembalian').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{ url('pengembalian/update/' . $pengembalian->id_pengembalian) }}",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                alert(response.message);
                $('#modalEditPengembalian').modal('hide');
                location.reload();
            },
            error: function () {
                alert('Gagal memperbarui data pengembalian');
            }
        });
    });
</script>
