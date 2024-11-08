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
                    <!-- BTN GROUP HEADER -->
                    <?php $this->view('components/btn_group_header'); ?>
                    <!-- End BTN GROUP HEADER -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Daftar Data <?= $service_name ?></h5>
                                </div>
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: 1em;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="no-sort">Kode Dokter</th>
                                                <th>Nama Dokter</th>
                                                <th class="no-sort">Telepon</th>
                                                <th class="no-sort">Alamat</th>
                                                <th class="no-sort">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($data_result as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $item->kode_dokter ?></td>
                                                    <td><?= $item->nama_dokter ?></td>
                                                    <td><?= $item->no_telepon ?></td>
                                                    <td><?= $item->alamat ?></td>
                                                    <td>
                                                        <?php $params = "[`$item->id_dokter`,`$item->kode_dokter`, `$item->nama_dokter`, `$item->no_telepon`, `$item->alamat` ]"; ?>
                                                        <!-- BTN GROUP TABLE -->
                                                        <?php $this->view('components/btn_group_table', ['id' => $item->id_dokter, 'params' => $params]); ?>
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
                            <input name="id_dokter" id="id_dokter" hidden>
                            <div class="form-group col-6">
                                <label for="kode_dokter" class="form-label">Kode Dokter</label>
                                <input type="text" name="kode_dokter" id="kode_dokter" class="form-control" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="nama_dokter" class="form-label">Nama Dokter</label>
                                <input type="text" name="nama_dokter" id="nama_dokter" class="form-control" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="no_telepon" class="form-label">Nomor Telepon</label>
                                <input type="number" name="no_telepon" id="no_telepon" class="form-control" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" required rows="3"></textarea>
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
    <?php $fields = ['id_dokter', 'kode_dokter', 'nama_dokter', 'no_telepon', 'alamat']; ?>
    <?php $this->view('components/script_form', ['fields' => $fields, 'service_name' => $service_name]); ?>
    <!-- End Script Form -->

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->

    <!-- Confirm Modal -->
    <?php $type = !isset($is_active_page) ? 'delete' : ($is_active_page == 'active' ?  'active' : 'nonactive'); ?>
    <?php $url = "$service_name/action_remove/" . (!isset($is_active_page) ? "delete" : ($is_active_page == 'active' ? "nonactive" : "active")) ?>
    <?php $this->view('components/confirm_modal', ['type' => $type, 'url' => $url]); ?>
    <!-- End Confirm Modal -->

    <!-- Toast Modal  -->
    <?php $this->view('templates/toasts'); ?>
    <!-- End Toast Modal  -->

    <!-- Logout Modal  -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal  -->
</body>

</html>