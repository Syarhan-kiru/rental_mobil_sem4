@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title mb-0">Data Mobil</h4>

                        <div>
                            <button type="button" class="btn btn-primary" onclick="tambahmobil()">
                                <i class="mdi mdi-plus"></i> Tambah Mobil
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">

                            <thead class="table-dark">
                                <tr>
                                    <th width="80">No</th>
                                    <th>Plat Nomor</th>
                                    <th>Merek</th>
                                    <th>Tahun</th>
                                    <th>Harga Sewa/Hari</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($mobil as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->plat_nomor }}</td>
                                        <td>{{ $row->merek }}</td>
                                        <td>{{ $row->tahun }}</td>
                                        <!-- format nya(angka database,berapa desimalnya,pemisah desimal,pesah ribuan) -->
                                        <td>Rp {{ number_format($row->harga_sewa_sehari, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($row->foto)
                                                <img src="{{ asset('storage/' . $row->foto) }}" width="80" alt="Foto Mobil">
                                            @else
                                                <span class="text-muted">Tidak ada foto</span>
                                            @endif
                                        </td>

                                        <td>{{ $row->status }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info btn-sm"
                                                onclick="editmobil('<?= $row->id_mobil ?>')" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                onclick="hapusmobil('<?= $row->id_mobil ?>')" title="Hapus">
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

    function tambahmobil() {
        $.ajax({
            url: "{{ url('mobil/tambah') }}",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                if (response.data) {
                    $(".viewmodal").html(response.data).show();
                    $("#modalTambahMobil").on("show.bs.modal", function (e) {
                        $("#fokus").focus();
                    });
                    $("#modalTambahMobil").modal("show");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "/n" + xhr.responseText + "/n" + thrownError);
            },
        });
    }
    function editmobil(kode) {
        $.ajax({
            type: "GET",
            url: "{{ url('mobil/edit') }}/" + kode,
            dataType: "json",
            success: function (response) {
                if (response.data) {
                    $(".viewmodal").html(response.data).show();
                    $("#modalEditMobil").on("shown.bs.modal", function (e) {
                        $("#nama").focus();
                    });
                    $("#modalEditMobil").modal("show");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function hapusmobil(kode) {
        if (!confirm('Yakin ingin menghapus data mobil ini?')) {
            return;
        }

        $.ajax({
            type: "GET",
            url: "{{ url('mobil/hapus') }}/" + kode,
            dataType: "json",
            success: function (response) {
                alert(response.message);
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>