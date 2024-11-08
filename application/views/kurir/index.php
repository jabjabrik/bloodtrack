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
                                    <h5 class="card-title mb-0">Daftar Data Pasien</h5>
                                </div>
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: 1em;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="no-sort">Kode Kurir</th>
                                                <th>Nama Kurir</th>
                                                <th class="no-sort">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($data_result as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $item->kode_kurir ?></td>
                                                    <td><?= $item->nama_kurir ?></td>
                                                    <td>
                                                        <?php $params = "[`$item->id_kurir`, `$item->kode_kurir`, `$item->nama_kurir`]"; ?>
                                                        <!-- BTN GROUP TABLE -->
                                                        <?php $this->view('components/btn_group_table', ['id' => $item->id_kurir, 'params' => $params]); ?>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize" id="title_form"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" autocomplete="off" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="id_kurir" id="id_kurir" hidden>
                            <div class="form-group col-12">
                                <label for="kode_kurir" class="form-label">Kode Kurir</label>
                                <input type="text" name="kode_kurir" id="kode_kurir" class="form-control" readonly>
                            </div>
                            <div class="form-group col-12">
                                <label for="nama_kurir" class="form-label">Nama Kuir</label>
                                <input type="text" name="nama_kurir" id="nama_kurir" class="form-control" required>
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
    <?php $fields = ['id_kurir', 'kode_kurir', 'nama_kurir']; ?>
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