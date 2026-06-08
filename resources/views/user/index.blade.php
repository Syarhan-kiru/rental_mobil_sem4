@extends('layout.main')

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">

            <div class="card-body">

                
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h4 class="card-title mb-0">
                        Manajemen User
                    </h4>

                    <a href="#" class="btn btn-primary" onclick="tambahuser()">

                        <i class="mdi mdi-plus"></i>
                        Tambah User

                    </a>

                </div>

                
                <div class="table-responsive">

                    <table class="table table-bordered table-hover" >

                        <thead class="table-dark">

                            <tr>
                                <th width="80">No</th>
                                <th>Kode User</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th width="120">Aksi</th>
                            </tr>

                        </thead>

                        <tbody>
                            <?php

                        $nomor = 0;
                            foreach ($user as $row):
                            $nomor++;
                            ?>
                            <tr>
                                <td><?= $nomor; ?></td>
                                <td><?= $row['kode_user']; ?></td>
                                <td><?= $row['nama_user']; ?></td>
                                <td><?= $row['email_user']; ?></td>
                                <td>
                                    <?php   
                                     if ($row['level_user'] == 1) {
                                    ?>
                                    MANAJER
                                    <?php
                                        } else if ($row['level_user'] == 2) {
                                    ?>
                                    ADMIN
                                    <?php 
                                        } else {
                                    ?>
                                    Karyawan
                                    <?php
                                    } ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-sm"
                                        onclick="edituser('<?= $row['kode_user']; ?>')" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                        onclick="hapususer('<?= $row['kode_user']; ?>')" title="Hapus">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>

                            </tr>

                           

                            <?php endforeach; ?>

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
    function tambahuser() {
        $.ajax({
            url: "{{ url('user/tambah') }}",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                if (response.data) {
                    $(".viewmodal").html(response.data).show();
                    $("#modalTambahUser").on("show.bs.modal", function (e) {
                        $("#fokus").focus();
                    });
                    $("#modalTambahUser").modal("show");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "/n" + xhr.responseText + "/n" + thrownError);
            },
        });
    }

    function edituser(kode) {
        $.ajax({
            url: "{{ url('user/edit') }}/" + kode,
            type: "GET",
            dataType: 'json',
            success: function (response) {
                if (response.data) {
                    $(".viewmodal").html(response.data).show();
                    $("#modalEditUser").on("shown.bs.modal", function () {
                        $("#nama_user_edit").focus();
                    });
                    $("#modalEditUser").modal("show");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }

    function hapususer(kode) {
        if (!confirm('Yakin ingin menghapus data user ini?')) {
            return;
        }

        $.ajax({
            url: "{{ url('user/hapus') }}/" + kode,
            type: "GET",
            dataType: 'json',
            success: function (response) {
                alert(response.message);
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }
</script>
