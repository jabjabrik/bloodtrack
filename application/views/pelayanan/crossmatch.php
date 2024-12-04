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
                    <h1 class="h3 mb-3"><i class="bi bi-person-vcard"></i> <span class="align-middle">Halaman Crossmatch Darah Pada Pasien <span class="fw-bold text-capitalize"><?= $pasien->nama_pasien ?></span></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('pelayanan'); ?>">Daftar Pasien</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url("pelayanan/pelayanan/$id_pasien"); ?>">Pelayanan</a></li>
                            <li class=" breadcrumb-item active" aria-current="page">Crossmatch</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-3">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="mb-0 fw-bolder text-center">INFORMASI PASIEN</h6>
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
                            <div class="card mb-3">
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="mb-0 text-center fw-bolder">INFORMASI STOK DARAH GOLDA <?= $pasien->golongan_darah ?></h6>
                                            <!-- <h6 class="mb-0 text-center fw-bolder">INFORMASI TRANSAKSI</h6> -->
                                        </div>
                                    </div>
                                    <hr>
                                    <?php foreach ($stok_darah as $item): ?>
                                        <div class="row">
                                            <div class="col-3">
                                                <h6 class="mb-0"><?= $item->jenis_darah ?></h6>
                                            </div>
                                            <div class="col-3 text-secondary">
                                                <span><?= $item->stok ?> Kantong</span>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php endforeach; ?>
                                    <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0 fw-bolder">Sisa Stok Bank Darah</h6>
                                        </div>
                                        <div class="col-3">
                                            <span class="fw-bolder"><?= $total_stok_darah ?> Kantong</span>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- <div class="row">
                                        <div class="col-3">
                                            <h6 class="mb-0">Total Biaya</h6>
                                        </div>
                                        <div class="col-3 text-secondary">
                                            <span>Rp.<?= number_format($total_biaya, 0, ',', '.'); ?></span>
                                        </div>
                                    </div>
                                    <hr> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-3">Total Biaya : Rp.<?= number_format($total_biaya, 0, ',', '.'); ?></h5>
                                    <?php if (empty($last_data) || !(bool)$last_data->status && $last_data->hasil == 'incompatible'): ?>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('tambah')">
                                            <i class="bi bi-plus-circle"></i> Tambah
                                        </button>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: 1em;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="no-sort">No Kantong</th>
                                                <th class="no-sort">Darah</th>
                                                <th class="no-sort">MY</th>
                                                <th class="no-sort">MN</th>
                                                <th class="no-sort">AK</th>
                                                <th class="no-sort">Hasil</th>
                                                <th class="no-sort">Subtotal</th>
                                                <?php if (!empty($last_data) && (bool)$last_data->status): ?>
                                                    <th class="no-sort">Status</th>
                                                <?php endif; ?>
                                                <th class="no-sort">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($data_result as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $item->no_kantong ?></td>
                                                    <td><?= "$item->jenis_darah | $item->golongan_darah" ?></td>
                                                    <td><?= $item->mayor ?></td>
                                                    <td><?= $item->minor ?></td>
                                                    <td><?= $item->autocontrol ?></td>
                                                    <td><?= $item->hasil ?></td>
                                                    <td>Rp.<?= number_format($item->tarif, 0, ',', '.'); ?></td>
                                                    <?php if ((bool)$last_data->status): ?>
                                                        <td>
                                                            <?php if ($item->hasil == 'compatible'): ?>
                                                                <?php if ($item->status == 'transfusi'): ?>
                                                                    <span style="cursor: pointer;" class="badge bg-primary" data-bs-toggle="tooltip" data-bs-title="Proses Transfusi Berhasil">
                                                                        Transfusi <i class="bi bi-info-circle"></i>
                                                                    </span>
                                                                <?php else: ?>
                                                                    <span style="cursor: pointer;" class="badge bg-info" data-bs-toggle="tooltip" data-bs-title="Proses Retur Berhasil">
                                                                        Retur <i class="bi bi-info-circle"></i>
                                                                    </span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                    <?php endif; ?>
                                                    <td>
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <?php if ($last_data->id_crossmatch == $item->id_crossmatch): ?>
                                                                <!-- <button id="btn_delete_nonactive" type="button" class="btn btn-outline-danger btn-sm me-1" data-id="<?= $item->id_crossmatch ?>" data-bs-toggle="modal" data-bs-target="#confirm_modal">
                                                                    <i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-title="Hapus data"></i>
                                                                </button> -->
                                                            <?php endif; ?>
                                                            <?php if ($item->hasil == 'compatible' && !(bool)$last_data->status): ?>
                                                                <a href="<?= base_url("pelayanan/crossmatch_transfusi_retur/transfusi/$item->id_crossmatch/$id_pelayanan/$item->id_penerimaan"); ?>" class="btn btn-primary me-1">Transfusi <i class="bi bi-arrow-right-circle"></i></a>
                                                                <a href="<?= base_url("pelayanan/crossmatch_transfusi_retur/retur/$item->id_crossmatch/$id_pelayanan/$item->id_penerimaan"); ?>" class="btn btn-info me-1">Retur <i class="bi bi-arrow-repeat"></i></a>
                                                            <?php endif; ?>
                                                        </div>
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
                    <h1 class="modal-title fs-5 text-capitalize" id="title_form">Form Crossmatch</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" autocomplete="off" action="<?= base_url('pelayanan/crossmatch_insert'); ?>">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="id_pelayanan" id="id_pelayanan" hidden value="<?= $id_pelayanan ?>">
                            <div class="form-group col-12">
                                <label for="id_penerimaan" class="form-label">Informasi Darah</label>
                                <select class="form-select" name="id_penerimaan" id="id_penerimaan" required>
                                    <option selected value="">-</option>
                                    <?php foreach ($darah_tersedia as $item): ?>
                                        <option value="<?= $item->id_penerimaan ?>"><?= "No Kantong : $item->no_kantong | Darah : $item->jenis_darah | Golda : $item->golongan_darah" ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="mayor" class="form-label">Mayor</label>
                                <select class="form-select" name="mayor" id="mayor" required>
                                    <option value="+" selected>+</option>
                                    <option value="-">-</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="minor" class="form-label">Minor</label>
                                <select class="form-select" name="minor" id="minor" required>
                                    <option value="+" selected>+</option>
                                    <option value="-">-</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="autocontrol" class="form-label">Auto Control</label>
                                <select class="form-select" name="autocontrol" id="autocontrol" required>
                                    <option value="+" selected>+</option>
                                    <option value="-">-</option>
                                </select>
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

    <!-- Toast Modal  -->
    <?php $this->view('templates/toasts'); ?>
    <!-- End Toast Modal  -->

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->

    <!-- Logout Modal  -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal  -->
</body>

</html>