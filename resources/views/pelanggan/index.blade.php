@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Data Pelanggan</h4>
                    <a href="#" class="btn btn-primary" onclick="tambahPelanggan()">
                        <i class="mdi mdi-plus"></i> Tambah Pelanggan
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="80">No</th>
                                <th>ID Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>NIK</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelanggan as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->id_pelanggan }}</td>
                                <td>{{ $row->nama_pelanggan }}</td>
                                <td>{{ $row->nik }}</td>
                                <td>{{ $row->no_hp }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-sm"
                                    onclick="editPelanggan('<?= $row->id_pelanggan ?>')" title="Edit">
                                    <i class="mdi mdi-pencil"></i>
                                </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                    onclick="hapusPelanggan('<?= $row->id_pelanggan ?>')" title="Hapus">
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

    function tambahPelanggan() {
        $.ajax({
            url: "{{ url('pelanggan/tambah') }}",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                if (response.data) {
                    $(".viewmodal").html(response.data).show();
                    $("#modalTambahPelanggan").modal("show");
                }
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
    }
    function editPelanggan(kode) {
    $.ajax({
        type: "GET",
        url: "{{ url('pelanggan/edit') }}/" + kode,
        dataType: "json",
        success: function(response) {
            if (response.data) {
                $(".viewmodal").html(response.data).show();
                $("#modalEditPelanggan").on("shown.bs.modal", function(e) {
                    $("#nama").focus();
                });
                $("#modalEditPelanggan").modal("show");
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

    function hapusPelanggan(kode) {
        if (!confirm('Yakin ingin menghapus data pelanggan ini?')) {
            return;
        }

        $.ajax({
            type: "GET",
            url: "{{ url('pelanggan/hapus') }}/" + kode,
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
