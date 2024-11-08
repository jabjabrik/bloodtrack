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
                    <h1 class="h3 mb-3"><i class="bi bi-person-vcard"></i> <span class="align-middle"> <span>Halaman Manajemen Pasien</span></h1>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('tambah')">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </button>
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
                                                <th>Nama PMI</th>
                                                <th>Contact Person</th>
                                                <th>Alamat</th>
                                                <th class="no-sort">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($pmi as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $item->nama_pmi ?></td>
                                                    <td><?= $item->contact_person ?></td>
                                                    <td><?= $item->alamat ?></td>
                                                    <td>
                                                        <?php $params = "[`$item->id_pmi`, `$item->nama_pmi`, `$item->contact_person`, `$item->alamat`, ]"; ?>
                                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('detail', <?= $params ?>)">
                                                                <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-title="Detail data pmi"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('edit', <?= $params ?>)">
                                                                <i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-title="Edit data pmi"></i>
                                                            </button>
                                                            <button id="delete-btn" type="button" class="btn btn-outline-danger btn-sm" data-id="<?= $item->id_pmi; ?>" data-bs-toggle="modal" data-bs-target="#modal_delete">
                                                                <span data-bs-toggle="tooltip" data-bs-title="Hapus data pmi">
                                                                    <i class="bi bi-trash"></i>
                                                                </span>
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
                            <input name="id_pmi" id="id_pmi" hidden>
                            <div class="form-group col-6">
                                <label for="nama_pmi" class="form-label">Nama PMI</label>
                                <input type="text" name="nama_pmi" id="nama_pmi" class="form-control" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="contact_person" class="form-label">Contact Person</label>
                                <input type="number" name="contact_person" id="contact_person" class="form-control" required>
                            </div>
                            <div class="form-group col-12">
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

    <!-- Script Modal Form -->
    <script>
        const modal_form = document.querySelector('#modal_form');
        const btn_submit = modal_form.querySelector('#btn_submit');

        const setForm = (title, data) => {
            modal_form.querySelector('#title_form').innerHTML = `${title} data PMI`

            const field = ['id_pmi', 'nama_pmi', 'contact_person', 'alamat'];
            field.forEach((e, i) => {
                const element = modal_form.querySelector(`#${field[i]}`);

                if (title === 'detail') {
                    element.setAttribute('disabled', '');
                } else {
                    element.removeAttribute('disabled', '');
                }

                if (element.tagName == 'INPUT') {
                    element.value = title === 'tambah' ? '' : data[i];
                } else {
                    element.innerHTML = title === 'tambah' ? '' : data[i];
                }
            })

            btn_submit.removeAttribute('hidden');

            if (title === 'detail') {
                btn_submit.setAttribute('hidden', '')
            }

            if (title === 'tambah') {
                modal_form.querySelector('form').setAttribute('action', '<?= base_url('pmi/insert') ?>');
                btn_submit.innerHTML = 'Simpan';
            }

            if (title === 'edit') {
                modal_form.querySelector('form').setAttribute('action', '<?= base_url('pmi/edit') ?>');
                btn_submit.innerHTML = 'Edit';
            }
        }
    </script>
    <!-- End Script Modal Form -->

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->

    <!-- Delete Modal -->
    <?php $this->view('templates/delete_modal', ['url' => "pmi/delete"]); ?>
    <!-- End Delete Modal -->

    <!-- Toast Modal  -->
    <?php $this->view('templates/toasts'); ?>
    <!-- End Toast Modal  -->

    <!-- Logout Modal  -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal  -->
</body>

</html>