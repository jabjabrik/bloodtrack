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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Daftar Data <?= $service_name ?></h5>
                                </div>
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: .9em;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="no-sort">Kode Darah</th>
                                                <th>Jenis Darah</th>
                                                <th>Golda <i class="bi bi-question-circle" data-bs-toggle="tooltip" data-bs-title="Golongan darah & rhesus" style="cursor: pointer;"></i></th>
                                                <th>Stok Min</th>
                                                <th>Stok Maks</th>
                                                <th>Harga beli</th>
                                                <th>Harga Jual</th>
                                                <th class="no-sort">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($data_result as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $item->kode_darah ?></td>
                                                    <td><?= $item->jenis_darah ?></td>
                                                    <td><?= "$item->golongan_darah $item->rhesus" ?></td>
                                                    <td><?= $item->stok_minimal ?></td>
                                                    <td><?= $item->stok_maksimal ?></td>
                                                    <td>Rp.<?= number_format($item->harga_beli, 0, ',', '.'); ?></td>
                                                    <td>Rp.<?= number_format($item->harga_jual, 0, ',', '.'); ?></td>
                                                    <td>
                                                        <?php $params = "[`$item->id_darah`, `$item->kode_darah`, `$item->jenis_darah`, `$item->golongan_darah`, `$item->rhesus`, `$item->stok_minimal`, `$item->stok_maksimal`, `$item->harga_beli`, `$item->harga_jual`]"; ?>
                                                        <!-- BTN GROUP TABLE -->
                                                        <?php $this->view('components/btn_group_table', ['id' => $item->id_darah, 'params' => $params]); ?>
                                                        <!-- End BTN GROUP TABLE -->
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
                    <h1 class="modal-title fs-5 text-capitalize" id="title_form"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" autocomplete="off" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="id_darah" id="id_darah" hidden>
                            <div class="form-group col-6">
                                <label for="kode_darah" class="form-label">Kode Darah</label>
                                <input type="text" name="kode_darah" id="kode_darah" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label for="jenis_darah" class="form-label">Jenis Darah</label>
                                <input type="text" name="jenis_darah" id="jenis_darah" class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <label for="golongan_darah" class="form-label">Golongan Darah</label>
                                <input type="text" name="golongan_darah" id="golongan_darah" class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <label for="rhesus" class="form-label">Rhesus</label>
                                <input type="text" name="rhesus" id="rhesus" class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <label for="stok_minimal" class="form-label">Stok Minimal</label>
                                <input type="number" name="stok_minimal" id="stok_minimal" class="form-control" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="stok_maksimal" class="form-label">Stok Maksimal</label>
                                <input type="number" name="stok_maksimal" id="stok_maksimal" class="form-control" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="harga_beli" class="form-label">Harga Beli</label>
                                <input type="number" name="harga_beli" id="harga_beli" class="form-control" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="harga_jual" class="form-label">Harga Jual</label>
                                <input type="number" name="harga_jual" id="harga_jual" class="form-control" required>
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

    <!-- Script Form -->
    <?php $fields = ['id_darah', 'kode_darah', 'jenis_darah', 'golongan_darah', 'rhesus', 'stok_minimal', 'stok_maksimal', 'harga_beli', 'harga_jual']; ?>
    <?php $this->view('components/script_form', ['fields' => $fields, 'service_name' => $service_name]); ?>
    <!-- End Script Form -->

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->

    <!-- Delete Nonactive Modal -->
    <?php $type = !isset($is_active_page) ? 'delete' : ($is_active_page == 'active' ?  'active' : 'nonactive'); ?>
    <?php $url = "$service_name/action_remove/" . (!isset($is_active_page) ? "delete" : ($is_active_page == 'active' ? "nonactive" : "active")) ?>
    <?php $this->view('components/confirm_modal', ['type' => $type, 'url' => $url]); ?>
    <!-- End Delete Nonactive Modal -->

    <!-- Toast Modal  -->
    <?php $this->view('templates/toasts'); ?>
    <!-- End Toast Modal  -->

    <!-- Logout Modal  -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal  -->
</body>

</html>