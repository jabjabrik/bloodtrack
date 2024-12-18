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
                    <div class="btn-group btn-group-sm">
                        <a href="<?= base_url('bankdarah'); ?>" class="me-1 btn btn-primary" aria-current="page">Stok Darah</a>
                        <a href="<?= base_url('bankdarah/detail'); ?>" class="me-1 btn btn-secondary">Detail Stok</a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Daftar data Bank Darah yang dapat digunakan</h5>
                                </div>
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: 1em;">
                                        <thead class="text-center">
                                            <tr>
                                                <th rowspan="2" style="vertical-align: middle">No</th>
                                                <th rowspan="2" style="vertical-align: middle" class="no-sort">Kode Darah</th>
                                                <th rowspan="2" style="vertical-align: middle" class="no-sort">Darah</th>
                                                <th colspan="3" style="vertical-align: middle" class="no-sort">Stok</th>
                                                <th rowspan="2" style="vertical-align: middle" class="no-sort">Harga Beli</th>
                                                <th rowspan="2" style="vertical-align: middle" class="no-sort">Harga Jual</th>
                                            </tr>
                                            <tr>
                                                <th class="no-sort">Min</th>
                                                <th class="no-sort">Maks</th>
                                                <th class="no-sort">Tesisa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($data_result as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $item->kode_darah ?></td>
                                                    <td><?= "$item->jenis_darah | $item->golongan_darah" ?></td>
                                                    <td><?= $item->stok_minimal ?></td>
                                                    <td><?= $item->stok_maksimal ?></td>
                                                    <td><?= $item->stok ?></td>
                                                    <td><?= $item->harga_beli ?></td>
                                                    <td><?= $item->harga_jual ?></td>
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

    <!-- Script -->
    <?php $this->view('templates/script'); ?>
    <!-- End Script -->

    <!-- Logout Modal  -->
    <?php $this->view('templates/logout_modal'); ?>
    <!-- End Logout Modal  -->
</body>

</html>