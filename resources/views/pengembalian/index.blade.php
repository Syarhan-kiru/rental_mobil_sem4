@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Data Pengembalian Mobil</h4>
                    <button type="button" class="btn btn-primary" onclick="tambahPengembalian()">
                        <i class="mdi mdi-plus"></i> Tambah Pengembalian
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="60">No</th>
                                <th>ID Pengembalian</th>
                                <th>ID Transaksi Sewa</th>
                                <th>Pelanggan</th>
                                <th>Mobil</th>
                                <th>Tanggal Dikembalikan</th>
                                <th>Kondisi Mobil</th>
                                <th>Denda (Rp)</th>
                                <th>Total Bayar (Rp)</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengembalian as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->id_pengembalian }}</td>
                                <td>{{ $row->id_penyewaan }}</td>
                                <td>{{ $row->penyewaan->pelanggan->nama_pelanggan ?? '-' }}</td>
                                <td>{{ $row->penyewaan->mobil->merek ?? '-' }} ({{ $row->penyewaan->mobil->plat_nomor ?? '-' }})</td>
                                <td>{{ \Carbon\Carbon::parse($row->tanggal_dikembalikan)->format('d-m-Y') }}</td>
                                <td>
                                    <span class="badge {{ $row->kondisi_mobil == 'Baik' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $row->kondisi_mobil }}
                                    </span>
                                </td>
                                <td>{{ number_format($row->denda, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($row->total_bayar, 0, ',', '.') }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-sm"
                                        onclick="editPengembalian('{{ $row->id_pengembalian }}')" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                        onclick="hapusPengembalian('{{ $row->id_pengembalian }}')" title="Hapus">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="viewmodal" style="display: none;"></div>

<script>
    // Setup CSRF Token Laravel untuk AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Fungsi Panggil Modal Tambah
    function tambahPengembalian() {
        $.ajax({
            url: "{{ url('pengembalian/tambah') }}",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                if (response.data) {
                    $(".viewmodal").html(response.data).show();
                    $("#modalTambahPengembalian").modal("show"); // Pastikan id modal di tambah.blade.php sesuai
                }
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
    }

    // Fungsi Panggil Modal Edit
    function editPengembalian(id) {
        $.ajax({
            url: "{{ url('pengembalian/edit') }}/" + id,
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.data) {
                    $(".viewmodal").html(response.data).show();
                    $("#modalEditPengembalian").modal("show"); // Pastikan id modal di edit.blade.php sesuai
                }
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
    }

    // Fungsi Hapus Data
    function hapusPengembalian(id) {
        if (!confirm('Yakin ingin menghapus data pengembalian ini? Status sewa & mobil akan dikembalikan ke semula.')) {
            return;
        }

        $.ajax({
            type: "GET",
            url: "{{ url('pengembalian/hapus') }}/" + id,
            dataType: "json",
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
@endsection