<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->view('templates/head'); ?>
</head>

<body>
    <div class="wrapper">
        <!-- SideBar -->
        <?php $this->view('templates/sidebar'); ?>
        <!-- End SideBar -->

        <div class="main">
            <!-- TopBar -->
            <?php $this->view('templates/topbar'); ?>
            <!-- End TopBar -->
            <main class="content p-4 pb-0">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><i class="bi bi-person-vcard"></i> <span class="align-middle">Halaman Pelayanan Pada Pasien <span class="fw-bold text-capitalize"><?= $pasien->nama_pasien ?></span></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('pelayanan'); ?>">Daftar Pasien</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pelayanan</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="mb-0 text-center fw-bolder">INFORMASI TRANSAKSI</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0">Nama Lengkap</h6>
                                        </div>
                                        <div class="col-3 text-secondary">
                                            <span><?= $pasien->nama_pasien ?></span>
                                        </div>
                                        <div class="col-3">
                                            <h6 class="mb-0">Golongan darah</h6>
                                        </div>
                                        <div class="col-3 text-secondary">
                                            <span><?= $pasien->golongan_darah ?></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0">NIK</h6>
                                        </div>
                                        <div class="col-3 text-secondary">
                                            <span><?= $pasien->nik ?></span>
                                        </div>
                                        <div class="col-3">
                                            <h6 class="mb-0">Jenis Kelamin</h6>
                                        </div>
                                        <div class="col-3 text-secondary">
                                            <span><?= $pasien->jenis_kelamin ?></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0">Tanggal Lahir</h6>
                                        </div>
                                        <div class="col-3 text-secondary">
                                            <span><?= $pasien->tanggal_lahir ?></span>
                                        </div>
                                        <div class="col-3">
                                            <h6 class="mb-0">Usia</h6>
                                        </div>
                                        <div class="col-3 text-secondary">
                                            <span><?= calculateAge($pasien->tanggal_lahir) ?> Tahun</span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0">Nomor Telepon</h6>
                                        </div>
                                        <div class="col-3 text-secondary">
                                            <span><?= $pasien->no_telepon ?></span>
                                        </div>
                                        <div class="col-3">
                                            <h6 class="mb-0">Alamat</h6>
                                        </div>
                                        <div class="col-3 text-secondary">
                                            <span><?= $pasien->alamat ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <?php if ($jabatan == 'perawat'): ?>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('tambah')">
                                            <i class="bi bi-plus-circle"></i> Tambah
                                        </button>
                                    <?php endif; ?>
                                    <a target="_blank" href="<?= base_url("pelayanan/report/$id_pasien"); ?>" class="btn btn-sm btn-success">
                                        <i class="bi bi-file-earmark-bar-graph"></i> Cetak Laporan
                                    </a>
                                </div>
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: 1em;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Rekam Medis</th>
                                                <th>Dokter</th>
                                                <th>Ruangan</th>
                                                <th>Diagnosa</th>
                                                <th>Jumlah Darah</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($data_result as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $item->rekam_medis ?></td>
                                                    <td><?= $item->nama_dokter ?></td>
                                                    <td><?= $item->nama_ruangan ?></td>
                                                    <td><?= $item->diagnosa ?></td>
                                                    <td><?= $item->jumlah_darah ?></td>
                                                    <td><?= $item->tanggal_pelayanan ?></td>
                                                    <td>
                                                        <a href="<?= base_url("pelayanan/crossmatch/$item->id_pelayanan"); ?>" class="btn btn-sm btn-primary">Crossmatch <i class="bi bi-arrow-right-circle"></i></a>
                                                        <?php if ($jabatan == 'perawat'): ?>
                                                            <button id="btn_delete_nonactive" type="button" class="btn btn-outline-danger btn-sm" data-id="<?= $item->id_pelayanan ?>" data-bs-toggle="modal" data-bs-target="#confirm_modal">
                                                                <i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-title="Hapus data"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php $no++ ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <?php $this->view('templates/footer'); ?>
            <!-- End Footer -->
        </div>
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="modal_form" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize" id="title_form">Form Pelayanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" autocomplete="off" action="<?= base_url('pelayanan/pelayanan_insert'); ?>">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="id_pasien" id="id_pasien" hidden value="<?= $pasien->id_pasien ?>">
                            <div class="form-group col-6">
                                <label for="rekam_medis" class="form-label">Rekam Medis</label>
                                <input type="text" name="rekam_medis" id="rekam_medis" class="form-control" readonly value="<?= $rekam_medis ?>">
                            </div>
                            <div class="form-group col-6">
                                <label for="id_dokter" class="form-label">Dokter</label>
                                <select class="form-select" name="id_dokter" id="id_dokter" required>
                                    <option selected value="">-</option>
                                    <?php foreach ($dokter as $item): ?>
                                        <option value="<?= $item->id_dokter ?>"><?= $item->nama_dokter ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="id_ruangan" class="form-label">Ruangan</label>
                                <select class="form-select" name="id_ruangan" id="id_ruangan" required>
                                    <option selected value="">-</option>
                                    <?php foreach ($ruangan as $item): ?>
                                        <option value="<?= $item->id_ruangan ?>"><?= $item->nama_ruangan ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="diagnosa" class="form-label">Diagnosa</label>
                                <input type="text" name="diagnosa" id="diagnosa" class="form-control" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="jumlah_darah" class="form-label">Jumlah Darah</label>
                                <input type="number" name="jumlah_darah" id="jumlah_darah" class="form-control" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="tanggal_pelayanan" class="form-label">Tanggal Pelayanan</label>
                                <input type="date" name="tanggal_pelayanan" id="tanggal_pelayanan" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button id="btn_submit" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Form -->


    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->

    <!-- Delete Nonactive Modal -->
    <?php $this->view('components/confirm_modal', ['type' => 'delete', 'url' => 'pelayanan/pelayanan_delete/']); ?>
    <!-- End Delete Nonactive Modal -->


    <!-- Toast Modal  -->
    <?php $this->view('templates/toasts'); ?>
    <!-- End Toast Modal  -->

    <!-- Logout Modal  -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal  -->
</body>

</html>