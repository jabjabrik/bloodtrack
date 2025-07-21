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
                    <div class="btn-group btn-group-sm" role="group">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                Daftar Menu
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="<?= base_url("$service_name"); ?>">
                                        <span class="text-capitalize"><?= $service_name ?></span>
                                        aktif
                                    </a>
                                    <a class="dropdown-item" href="<?= base_url("$service_name/nonactive"); ?>">
                                        <span class="text-capitalize"><?= $service_name ?></span>
                                        tidak aktif
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="<?= base_url('ruangan/ruangpetugas'); ?>" class="btn btn-success btn-sm">
                        <i class="bi bi-receipt"></i> Ruangan Petugas
                    </a>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Data Ruangan Petugas</h5>
                                </div>
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: 1em;">
                                        <thead>
                                            <tr>
                                                <th class="no-sort">No</th>
                                                <th class="no-sort">Kode Perawat</th>
                                                <th class="no-sort">Nama Perawat</th>
                                                <th class="no-sort">Kode Ruangan</th>
                                                <th class="no-sort">Nama Ruangan</th>
                                                <th class="no-sort">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($data_result as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $item->kode_petugas ?></td>
                                                    <td><?= $item->nama_petugas ?></td>
                                                    <td><?= $item->kode_ruangan ?? '-' ?></td>
                                                    <td><?= $item->nama_ruangan ?? '-' ?></td>
                                                    <td>
                                                        <?php $params = "[`$item->id_petugas`,`$item->id_ruangan`]" ?>
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <button type="button" class="btn btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('edit',<?= $params ?>)">
                                                                <i class="bi bi-person-fill-gear"></i>
                                                            </button>
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

    <div class="modal fade" id="modal_form" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize">Form Ruangan Petugas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" autocomplete="off" action="<?= base_url('ruangan/edit_ruangan_petugas') ?>">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input name="id_petugas" id="id_petugas" hidden>
                            <div class="form-group col-12">
                                <label for="id_ruangan" class="form-label">Pilih Ruangan</label>
                                <select class="form-select" id="id_ruangan" name="id_ruangan">
                                    <option value="-">-</option>
                                    <?php foreach ($ruangan as $item): ?>
                                        <option value="<?= $item->id_ruangan ?>"><?= $item->nama_ruangan ?></option>
                                    <?php endforeach; ?>
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

    <!-- Script Form -->
    <script>
        const modal_form = document.querySelector('#modal_form');

        const setForm = (title, data) => {
            const fields = ['id_petugas', 'id_ruangan'];
            fields.forEach((e, i) => {
                const element = modal_form.querySelector(`#${e}`);
                element.value = data[i] || '-';
            })
        }
    </script>
    <!-- End Script Form -->

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