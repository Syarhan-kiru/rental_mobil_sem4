<div class="modal fade" id="modalTambahPengembalian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="formTambahPengembalian">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengembalian Mobil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">ID Pengembalian</label>
                        <input type="text" name="id_pengembalian" class="form-control" value="{{ $kodePengembalian }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pilih Transaksi Sewa (ID - Pelanggan - Mobil)</label>
                        <select name="id_penyewaan" id="id_penyewaan" class="form-control" required>
                            <option value="">-- Pilih Transaksi Berjalan --</option>
                            @foreach ($penyewaanAktiv as $sewa)
                                <option value="{{ $sewa->id_penyewaan }}" 
                                        data-totalharga="{{ $sewa->total_harga }}"
                                        data-tglkembali="{{ $sewa->tanggal_kembali }}">
                                    {{ $sewa->id_penyewaan }} - {{ $sewa->pelanggan->nama_pelanggan ?? '-' }} ({{ $sewa->mobil->merek ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Dikembalikan (Hari Ini)</label>
                        <input type="date" name="tanggal_dikembalikan" id="tanggal_dikembalikan" class="form-control" value="{{ date('Y-m-content') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kondisi Mobil Saat Kembali</label>
                        <select name="kondisi_mobil" id="kondisi_mobil" class="form-control" required>
                            <option value="Baik">Baik (Tidak Ada Denda)</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Denda Keterlambatan/Kerusakan (Rp)</label>
                            <input type="number" name="denda" id="denda" class="form-control" value="0" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total Yang Harus Dibayar (Rp)</label>
                            <input type="number" name="total_bayar" id="total_bayar" class="form-control" value="0" readonly>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pengembalian</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    // Hitung Otomatis Denda & Total Bayar saat Transaksi Terpilih atau Kondisi Berubah
    function hitungTotalPengembalian() {
        const transaksi = $('#id_penyewaan option:selected');
        if (!transaksi.val()) return;

        const totalHargaSewa = parseInt(transaksi.data('totalharga')) || 0;
        const tglHarusKembali = new Date(transaksi.data('tglkembali'));
        const tglKembaliAktif = new Date($('#tanggal_dikembalikan').val());
        
        let dendaKeterlambatan = 0;

        // 1. Cek Keterlambatan (Misal: Denda Rp 50.000 / hari jika telat)
        if (tglKembaliAktif > tglHarusKembali) {
            const selisihWaktu = tglKembaliAktif - tglHarusKembali;
            const selisihHari = Math.ceil(selisihWaktu / (1000 * 60 * 60 * 24));
            dendaKeterlambatan = selisihHari * 50000; 
        }

        // 2. Cek Kondisi Fisik Mobil
        let dendaKerusakan = 0;
        const kondisi = $('#kondisi_mobil').val();
        if (kondisi === 'Rusak Ringan') dendaKerusakan = 200000;
        if (kondisi === 'Rusak Berat') dendaKerusakan = 1000000;

        const totalDenda = dendaKeterlambatan + dendaKerusakan;
        $('#denda').val(totalDenda);
        $('#total_bayar').val(totalHargaSewa + totalDenda);
    }

    $('#id_penyewaan, #kondisi_mobil, #tanggal_dikembalikan').on('change', function() {
        hitungTotalPengembalian();
    });

    // Kirim Data Lewat AJAX Form
    $('#formTambahPengembalian').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{ url('pengembalian/simpan') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                alert('Data pengembalian berhasil diproses, status mobil kembali tersedia!');
                $('#modalTambahPengembalian').modal('hide');
                location.reload();
            },
            error: function (xhr) {
                alert('Gagal menyimpan data pengembalian: ' + xhr.responseText);
            }
        });
    });
</script>