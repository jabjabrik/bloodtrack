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
                    <h1 class="h3 mb-3"><i class="bi bi-person-vcard"></i> <span class="align-middle">Halaman Pelayanan Pasien</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Daftar Pasien</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Daftar Data Pasien</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_cetak_laporan">
                                            <i class="bi bi-file-earmark-bar-graph"></i> Cetak Laporan Pelayanan
                                        </button>
                                    </div>
                                    <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: 1em;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Pasien</th>
                                                <th class="no-sort">NIK</th>
                                                <th>Nama Pasien</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Umur</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($data_result as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $item->kode_pasien ?></td>
                                                    <td><?= $item->nik ?></td>
                                                    <td><?= $item->nama_pasien ?></td>
                                                    <td><?= $item->jenis_kelamin ?></td>
                                                    <td><?= date('d-m-Y', strtotime($item->tanggal_lahir)) ?></td>
                                                    <td><?= calculateAge($item->tanggal_lahir) ?> Tahun</td>
                                                    <td>
                                                        <a href="<?= base_url("pelayanan/pelayanan/$item->id_pasien"); ?>" class="btn btn-sm btn-primary">
                                                            Lihat RM
                                                            <i class="bi bi-arrow-right-circle"></i>
                                                        </a>
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
                <form method="POST" autocomplete="off" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="id_pasien" id="id_pasien" hidden>
                            <div class="form-group col-6">
                                <label for="kode_pelayanan" class="form-label">Kode Pelayanan</label>
                                <input type="text" name="kode_pelayanan" id="kode_pelayanan" class="form-control" readonly value="<?= $kode_pelayanan ?>">
                            </div>
                            <div class="form-group col-6">
                                <label for="id_pasien" class="form-label">Pasien</label>
                                <select class="form-select" name="id_pasien" id="id_pasien" required>
                                    <option selected>-</option>
                                    <?php foreach ($pasien as $item): ?>
                                        <option value="<?= $item->id_pasien ?>"><?= "$item->rekam_medis | $item->nama_pasien" ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="id_dokter" class="form-label">Dokter</label>
                                <select class="form-select" name="id_dokter" id="id_dokter" required>
                                    <option selected>-</option>
                                    <?php foreach ($dokter as $item): ?>
                                        <option value="<?= $item->id_dokter ?>"><?= "$item->kode_dokter | $item->nama_dokter" ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="id_ruangan" class="form-label">Ruangan</label>
                                <select class="form-select" name="id_ruangan" id="id_ruangan" required>
                                    <option selected>-</option>
                                    <?php foreach ($ruangan as $item): ?>
                                        <option value="<?= $item->id_ruangan ?>"><?= "$item->kode_ruangan | $item->nama_ruangan" ?> </option>
                                    <?php endforeach; ?>
                                </select>
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

    <!-- Modal Cetak Laporan -->
    <div class="modal fade" id="modal_cetak_laporan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cetak Laporan Pelayanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="GET" action="<?= base_url('pelayanan/report'); ?>" target="_blank">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Pilih Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Cetak Laporan -->


    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->


    <!-- Toast Modal  -->
    <?php $this->view('templates/toasts'); ?>
    <!-- End Toast Modal  -->

    <!-- Logout Modal  -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal  -->
</body>

</html>