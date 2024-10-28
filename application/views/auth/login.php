<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->view('templates/head'); ?>
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="text-center mt-4">
                            <h1 class="h2">Selamat Datang Kembali!</h1>
                            <p class="lead">
                                Login untuk masuk kedalam aplikasi
                            </p>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-3">
                                    <form action="<?= base_url() ?>" method="POST" autocomplete="off">
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input class="form-control form-control-lg" type="text" name="username" placeholder="Masukan Username" value="<?= set_value('username'); ?>">
                                            <?= form_error('username', '<small class="text-danger my-1 pl-3 d-block" style="text-align: left;">', '</small>'); ?>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password" id="password" placeholder="Masukan password" value="<?= set_value('password'); ?>">
                                            <div style="position: relative;">
                                                <i id="eye" hidden class="bi bi-eye" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                                <i id="eye" class="bi bi-eye-slash" style="position: absolute; right: 10px; top: -30px; cursor: pointer;"></i>
                                            </div>
                                            <?= form_error('password', '<small class="text-danger my-1 pl-3 d-block" style="text-align: left;">', '</small>'); ?>
                                        </div>
                                        <div class="d-grid gap-2 mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Eye Icon Password -->
    <?php $this->view('templates/eye_icon_password'); ?>
    <!-- Eye Icon Password -->
</body>

</html>