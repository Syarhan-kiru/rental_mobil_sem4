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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Level</th>
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
     
</script>