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
                    <h1 class="h3 mb-3"><strong>Dashboard</strong> Blood Track</h1>

                    <div class="row g-3">
                        <div class="px-3 col-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <a href="<?= base_url('petugas'); ?>" class="card-title">Data Petugas</a>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?= $total_petugas ?></h1>
                                    <div class="mb-0">
                                        <span class="text-primary"> <i class="mdi bi bi-stickies-fill"></i></span>
                                        <span class="text-muted"> Total Data Petugas</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-3 col-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <a href="<?= base_url('dokter'); ?>" class="card-title">Data Dokter</a>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-warning">
                                                <i class="bi bi-person-badge"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?= $total_dokter ?></h1>
                                    <div class="mb-0">
                                        <span class="text-warning"> <i class="mdi bi bi-stickies-fill"></i></span>
                                        <span class="text-muted"> Total Data Dokter</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-3 col-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <a href="<?= base_url('pasien'); ?>" class="card-title">Data Pasien</a>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-success">
                                                <i class="bi bi-person-vcard"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?= $total_pasien ?></h1>
                                    <div class="mb-0">
                                        <span class="text-success"> <i class="mdi bi bi-stickies-fill"></i></span>
                                        <span class="text-muted"> Total Data Pasien</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-3 col-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <a href="<?= base_url('penerima'); ?>" class="card-title">Data Penerima</a>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="bi bi-person-workspace"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?= $total_penerima ?></h1>
                                    <div class="mb-0">
                                        <span class="text-primary"> <i class="mdi bi bi-stickies-fill"></i></span>
                                        <span class="text-muted"> Total Data Penerima</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-3 col-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <a href="<?= base_url('darah'); ?>" class="card-title">Data Darah</a>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-warning">
                                                <i class="bi bi-person-workspace"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?= $total_darah ?></h1>
                                    <div class="mb-0">
                                        <span class="text-warning"> <i class="mdi bi bi-stickies-fill"></i></span>
                                        <span class="text-muted"> Total Data Darah</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-3 col-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <a href="<?= base_url('pmi'); ?>" class="card-title">Data PMI</a>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-success">
                                                <i class="bi bi-patch-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?= $total_pmi ?></h1>
                                    <div class="mb-0">
                                        <span class="text-success"> <i class="mdi bi bi-stickies-fill"></i></span>
                                        <span class="text-muted"> Total Data PMI</span>
                                    </div>
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

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->

    <!-- Logout Modal  -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal  -->
</body>

</html>