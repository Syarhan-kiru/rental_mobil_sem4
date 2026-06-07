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
                        <select name="kondisi_mobil" class="form-control" required>
                            <option value="Baik" {{ $pengembalian->kondisi_mobil == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Lecet" {{ $pengembalian->kondisi_mobil == 'Lecet' ? 'selected' : '' }}>Lecet</option>
                            <option value="Rusak" {{ $pengembalian->kondisi_mobil == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Denda Terlambat/Kerusakan (Rp)</label>
                        <input type="number" name="denda" id="denda_edit" class="form-control" value="{{ $pengembalian->denda }}" required>
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
        const totalHargaSewa = parseInt(sewaTerpilih.data('totalharga'), 10) || 0;
        const denda = parseInt($('#denda_edit').val(), 10) || 0;

        $('#total_bayar_edit').val(totalHargaSewa + denda);
    }

    $('#id_penyewaan_edit, #denda_edit').on('change input', function () {
        hitungTotalPengembalianEdit();
    });

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