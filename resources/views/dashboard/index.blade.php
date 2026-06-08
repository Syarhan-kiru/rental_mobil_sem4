@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Data Mobil</p>
                            <h3 class="mb-1">{{ $dashboardStats['total_mobil'] }}</h3>
                            <p class="mb-0 text-muted">Total mobil terdaftar</p>
                        </div>
                        <div class="icon icon-box-primary">
                            <span class="mdi mdi-car text-primary fs-3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Data Pelanggan</p>
                            <h3 class="mb-1">{{ $dashboardStats['total_pelanggan'] }}</h3>
                            <p class="mb-0 text-muted">Total pelanggan terdaftar</p>
                        </div>
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-account-multiple text-success fs-3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Total Transaksi</p>
                            <h3 class="mb-1">{{ $dashboardStats['total_transaksi'] }}</h3>
                            <p class="mb-0 text-muted">Semua transaksi penyewaan</p>
                        </div>
                        <div class="icon icon-box-warning">
                            <span class="mdi mdi-swap-horizontal text-warning fs-3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Transaksi Berjalan</p>
                            <h3 class="mb-1">{{ $dashboardStats['transaksi_berjalan'] }}</h3>
                            <p class="mb-0 text-muted">Penyewaan yang masih aktif</p>
                        </div>
                        <div class="icon icon-box-info">
                            <span class="mdi mdi-timer-sand text-info fs-3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3">
                        <div>
                            <h4 class="card-title mb-1">Mobil Tersedia</h4>
                            <p class="text-muted mb-0">Daftar mobil yang saat ini siap digunakan untuk transaksi penyewaan.</p>
                        </div>
                        <a href="{{ route('mobil.index') }}" class="btn btn-primary mt-3 mt-md-0">
                            Lihat Semua Mobil
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Mobil</th>
                                    <th>Plat Nomor</th>
                                    <th>Merek</th>
                                    <th>Tipe</th>
                                    <th>Tahun</th>
                                    <th>Harga / Hari</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mobilTersedia as $mobil)
                                    <tr>
                                        <td>{{ $mobil->id_mobil }}</td>
                                        <td>{{ $mobil->plat_nomor }}</td>
                                        <td>{{ $mobil->merek }}</td>
                                        <td>{{ $mobil->tipe }}</td>
                                        <td>{{ $mobil->tahun }}</td>
                                        <td>Rp {{ number_format($mobil->harga_sewa_sehari, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge badge-success text-uppercase">{{ $mobil->status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Belum ada mobil yang tersedia saat ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
