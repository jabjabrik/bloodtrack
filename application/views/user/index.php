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
            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><i class="align-middle" data-feather="users"></i> Halaman Manajemen User</h1>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('tambah')">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </button>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Daftar Data User</h5>
                                </div>
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: 1em;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th class="no-sort">Password</th>
                                                <th>Role</th>
                                                <th class="no-sort">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($user as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $item->nama ?></td>
                                                    <td class="text-lowercase"><?= $item->username ?></td>
                                                    <td>...</td>
                                                    <td><?= $item->role ?></td>
                                                    <td>
                                                        <?php $params = "$item->id_user,$item->nama,$item->username" ?>
                                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('edit','<?= $params ?>')">
                                                                <i class="bi bi-pencil-square"></i> Edit
                                                            </button>
                                                            <button type="button" id="delete-btn" <?= $item->role === 'admin' ? 'disabled' : '' ?> class="btn btn-outline-danger btn-sm" data-id="<?= $item->id_user; ?>" data-bs-toggle="modal" data-bs-target="#modal_delete">
                                                                <i class="bi bi-trash"></i> Delete
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
                <form id="modal-form" method="POST" autocomplete="off">
                    <div class="modal-body">
                        <div class="row g-3">
                            <input type="text" name="id_user" id="id_user" hidden>
                            <div class="form-group col-md-6 col-12">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                                <div class="form-text">Panjang Username Minimal 8 Karakter</div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="password" class="form-label">Masukan Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                <div style="position: relative;">
                                    <i id="eye" hidden class="bi bi-eye" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                    <i id="eye" class="bi bi-eye-slash" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                </div>
                                <div id="passwordHelpBlock" class="form-text"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Form -->




    <!-- Script Modal Form -->
    <script>
        const title_form = document.querySelector('#title_form')
        const modal_form = document.querySelector('#modal-form')

        const id_user = document.querySelector('#id_user')
        const nama = document.querySelector('#nama')
        const username = document.querySelector('#username')
        const password = document.querySelector('#password')
        const passwordHelpBlock = document.querySelector('#passwordHelpBlock')

        const clearForm = () => {
            id_user.value = '';
            nama.value = '';
            username.value = '';
            password.setAttribute('required', '')
            passwordHelpBlock.innerHTML = 'Panjang Passowrd Minimal 8 Karakter'
        }

        const setForm = (title, data) => {
            clearForm();
            title_form.innerHTML = `${title} Data User`

            if (title === 'tambah') {
                modal_form.setAttribute('action', '<?= base_url('user/create') ?>')
            }

            if (title === 'edit') {
                modal_form.setAttribute('action', '<?= base_url('user/edit') ?>')
                const user = data.split(',')
                id_user.value = user[0]
                nama.value = user[1]
                username.value = user[2]
                password.removeAttribute('required');
                passwordHelpBlock.innerHTML = 'Biarkan Input Password Kosong, Bila Tidak Ingin Merubah Password'
            }
        }
    </script>
    <!-- End Script Modal Form -->

    <!-- Eye Icon Password -->
    <?php $this->view('templates/eye_icon_password'); ?>
    <!-- Eye Icon Password -->

    <!-- Delete Modal -->
    <?php $this->view('templates/delete_modal', ['name' => 'user/delete']); ?>
    <!-- End Delete Modal -->

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->

    <!-- Logout Modal  -->
    <?php $this->view('templates/toasts'); ?>
    <!-- End Logout Modal  -->

    <!-- Logout Modal  -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal  -->
</body>

</html>