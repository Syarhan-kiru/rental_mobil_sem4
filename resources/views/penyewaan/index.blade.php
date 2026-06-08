@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Data Penyewaan</h4>
                    <a href="#" class="btn btn-primary" onclick="tambahPenyewaan()">
                        <i class="mdi mdi-plus"></i> Tambah Penyewaan
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="80">No</th>
                                <th>ID Penyewaan</th>
                                <th>User</th>
                                <th>Pelanggan</th>
                                <th>Mobil</th>
                                <th>Tanggal Sewa</th>
                                <th>Tanggal Kembali</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyewaan as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->id_penyewaan }}</td>
                                <td>{{ $row->user->nama_user ?? '-' }}</td>
                                <td>{{ $row->pelanggan->nama_pelanggan ?? '-' }}</td>
                                <td>{{ $row->mobil->merek ?? '-' }}</td>
                                <td>{{ $row->tanggal_sewa }}</td>
                                <td>{{ $row->tanggal_kembali ?? '-' }}</td>
                                <td>Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge {{ $row->status == 'berjalan' ? 'bg-warning' : 'bg-success' }}">
                                        {{ ucfirst($row->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-sm"
                                        onclick="editPenyewaan('{{ $row->id_penyewaan }}')" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                    onclick="hapusPenyewaan('<?= $row->id_penyewaan ?>')" title="Hapus">
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
@endsection

<div class="viewmodal" style="display: none;"></div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function tambahPenyewaan() {
        $.ajax({
            url: "{{ url('penyewaan/tambah') }}",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                if (response.data) {
                    $(".viewmodal").html(response.data).show();
                    $("#modalTambahPenyewaan").modal("show");
                }
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
    }

    function editPenyewaan(kode) {
        $.ajax({
            url: "{{ url('penyewaan/edit') }}/" + kode,
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.data) {
                    $(".viewmodal").html(response.data).show();
                    $("#modalEditPenyewaan").modal("show");
                }
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
    }
     function hapusPenyewaan(kode) {
        if (!confirm('Yakin ingin menghapus data penyewaan ini?')) {
            return;
        }

        $.ajax({
            type: "GET",
            url: "{{ url('penyewaan/hapus') }}/" + kode,
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
