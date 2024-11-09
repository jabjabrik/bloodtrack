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
                    <h1 class="h3 mb-3"><i class="bi bi-person-vcard"></i> <span class="align-middle text-capitalize"><?= $page_title; ?></h1>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_form">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </button>
                    <div class="btn-group btn-group-sm">
                        <a href="<?= base_url('pelayanan'); ?>" class="me-1 btn btn-primary active" aria-current="page">Pelayanan Pasien</a>
                        <!-- <a href="<?= base_url('bankdarah/kadaluarsa'); ?>" class="me-1 btn btn-primary">Diagnosa</a> -->
                        <!-- <a href="<?= base_url('bankdarah/kadaluarsa'); ?>" class="me-1 btn btn-primary">Permintaan Darah</a> -->
                        <!-- <a href="<?= base_url('bankdarah/kadaluarsa'); ?>" class="me-1 btn btn-primary">Tranfusi Darah</a> -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Daftar Data Pasien</h5>
                                </div>
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: .9em;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Pelayanan</th>
                                                <th>Nama Pasien</th>
                                                <th>Rekam Medis</th>
                                                <th>Dokter</th>
                                                <th>Ruangan</th>
                                                <th>Tanggal</th>
                                                <th class="no-sort">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($data_result as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $item->kode_pelayanan ?></td>
                                                    <td><?= $item->nama_pasien ?></td>
                                                    <td><?= $item->rekam_medis ?></td>
                                                    <td><?= $item->nama_dokter ?></td>
                                                    <td><?= $item->nama_ruangan ?></td>
                                                    <td><?= $item->tanggal_pelayanan ?></td>
                                                    <td>
                                                        <?php $params = "[]"; ?>
                                                        <a href="<?= base_url("pelayanan/permintaan/$item->id_pelayanan"); ?>" class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-clipboard-plus" data-bs-title="Detail data pasien"></i> Permintaan
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