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
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_form_insert">
                        <i class=" bi bi-plus-circle"></i> Tambah
                    </button>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Daftar Data Transaksi <?= $service_name ?> Darah PMI</h5>
                                </div>
                                <div class="card-body">
                                    <table id="datatables" class="table table-striped table-bordered text-capitalize" style="white-space: nowrap; font-size: 1em;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Penerimaan</th>
                                                <th>No Kantong</th>
                                                <th>Darah</th>
                                                <th>PMI</th>
                                                <th>Tgl Terima</th>
                                                <th class="no-sort">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($data_result as $item) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $item->kode_penerimaan ?></td>
                                                    <td><?= $item->no_kantong ?></td>
                                                    <td><?= "$item->jenis_darah | $item->golongan_darah" ?></td>
                                                    <td><?= $item->nama_pmi ?></td>
                                                    <td><?= $item->tanggal_terima ?></td>
                                                    <td>
                                                        <?php $params = "[`$item->kode_penerimaan`,`$item->no_kantong`, `$item->tanggal_terima`,`$item->tanggal_aftap`,`$item->tanggal_kadaluarsa`,`$item->kode_darah`,`$item->jenis_darah | $item->golongan_darah`,`$item->kode_pmi`,`$item->nama_pmi`,`$item->kode_kurir`,`$item->nama_kurir`,`$item->kode_penerima`,`$item->nama_penerima`]"; ?>
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_form_detail" onclick="setFormDetail(<?= $params ?>)">
                                                                <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-title="Detail data Penerimaan"></i>
                                                            </button>
                                                            <button id="btn_delete_nonactive" type="button" class="btn btn-outline-danger btn-sm" data-id="<?= $item->id_penerimaan ?>" data-bs-toggle="modal" data-bs-target="#confirm_modal">
                                                                <i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-title="Hapus data Penerimaan"></i>
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

    <!-- Modal Form Insert -->
    <div class="modal fade" id="modal_form_insert" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize">Tambah Data Transaksi Penerimaan Darah Dari PMI</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" autocomplete="off" action="<?= base_url('penerimaan/insert'); ?>">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="form-group col-6">
                                <label for="id_darah" class="form-label">Informasi Darah</label>
                                <select class="form-select" name="id_darah" id="id_darah" required>
                                    <option selected value="">-</option>
                                    <?php foreach ($darah as $item): ?>
                                        <option value="<?= $item->id_darah ?>"><?= "$item->jenis_darah | $item->golongan_darah"  ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="id_pmi" class="form-label">Informasi PMI</label>
                                <select class="form-select" name="id_pmi" id="id_pmi" required>
                                    <option selected value="">-</option>
                                    <?php foreach ($pmi as $item): ?>
                                        <option value="<?= $item->id_pmi ?>"><?= "$item->nama_pmi"  ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="id_pmi" class="form-label">Informasi Kurir</label>
                                <select class="form-select" name="id_kurir" id="id_kurir" required>
                                    <option selected value="">-</option>
                                    <?php foreach ($kurir as $item): ?>
                                        <option value="<?= $item->id_kurir ?>"><?= "$item->nama_kurir"  ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="id_pmi" class="form-label">Informasi Penerima</label>
                                <select class="form-select" name="id_penerima" id="id_penerima" required>
                                    <option selected value="">-</option>
                                    <?php foreach ($penerima as $item): ?>
                                        <option value="<?= $item->id_penerima ?>"><?= "$item->nama_penerima"  ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="kode_penerimaan" class="form-label">Kode Penerimaan</label>
                                <input type="text" name="kode_penerimaan" id="kode_penerimaan" class="form-control" value="<?= $kode_penerimaan ?>" readonly>
                            </div>
                            <div class="form-group col-4">
                                <label for="no_kantong" class="form-label">No Kantong</label>
                                <input type="text" name="no_kantong" id="no_kantong" class="form-control" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="tanggal_terima" class="form-label">Tanggal Terima</label>
                                <input type="date" name="tanggal_terima" id="tanggal_terima" class="form-control" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="tanggal_aftap" class="form-label">Tanggal Aftap</label>
                                <input type="date" name="tanggal_aftap" id="tanggal_aftap" class="form-control" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                                <input type="date" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" class="form-control" required>
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
    <!-- End Modal Form Insert -->

    <!-- Modal Form Detail -->
    <div class="modal fade" id="modal_form_detail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize">Detail Transaksi Penerimaan Darah Dari PMI</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <h5 class="h5 text-center">Informasi Penerimaan</h5>
                        <div class="form-group col-4">
                            <label for="kode_penerimaan" class="form-label">Kode Penerimaan</label>
                            <input type="text" name="kode_penerimaan" id="kode_penerimaan" class="form-control" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="no_kantong" class="form-label">No Kantong</label>
                            <input type="text" name="no_kantong" id="no_kantong" class="form-control" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="tanggal_terima" class="form-label">Tanggal Terima</label>
                            <input type="text" name="tanggal_terima" id="tanggal_terima" class="form-control" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="tanggal_aftap" class="form-label">Tanggal Aftap</label>
                            <input type="text" name="tanggal_aftap" id="tanggal_aftap" class="form-control" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                            <input type="text" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row g-3 pt-4">
                        <div class="col-6">
                            <div class="row g-3 mt-2">
                                <h5 class="h5 text-center">Informasi Darah</h5>
                                <div class="form-group col-12">
                                    <label for="kode_darah" class="form-label">Kode Darah</label>
                                    <input type="text" name="kode_darah" id="kode_darah" class="form-control" disabled>
                                </div>
                                <div class="form-group col-12">
                                    <label for="jenis_darah_golda" class="form-label">Jenis Darah & Golda</label>
                                    <input type="text" name="jenis_darah_golda" id="jenis_darah_golda" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row g-3 mt-2">
                                <h5 class="h5 text-center">Informasi PMI</h5>
                                <div class="form-group col-12">
                                    <label for="kode_pmi" class="form-label">Kode PMI</label>
                                    <input type="text" name="kode_pmi" id="kode_pmi" class="form-control" disabled>
                                </div>
                                <div class="form-group col-12">
                                    <label for="nama_pmi" class="form-label">Nama PMI</label>
                                    <input type="text" name="nama_pmi" id="nama_pmi" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row g-3 mt-2">
                                <h5 class="h5 text-center">Informasi Kurir</h5>
                                <div class="form-group col-12">
                                    <label for="kode_kurir" class="form-label">Kode Kurir</label>
                                    <input type="text" name="kode_kurir" id="kode_kurir" class="form-control" disabled>
                                </div>
                                <div class="form-group col-12">
                                    <label for="nama_kurir" class="form-label">Nama Kurir</label>
                                    <input type="text" name="nama_kurir" id="nama_kurir" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row g-3 mt-2">
                                <h5 class="h5 text-center">Informasi Penerima</h5>
                                <div class="form-group col-12">
                                    <label for="kode_penerima" class="form-label">Kode Penerima</label>
                                    <input type="text" name="kode_penerima" id="kode_penerima" class="form-control" disabled>
                                </div>
                                <div class="form-group col-12">
                                    <label for="nama_penerima" class="form-label">Nama Penerima</label>
                                    <input type="text" name="nama_penerima" id="nama_penerima" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Form Detail -->

    <!-- Script Form -->
    <script>
        const modal_form_detail = document.querySelector('#modal_form_detail');

        const setFormDetail = (data) => {
            const fields = ['kode_penerimaan', 'no_kantong', 'tanggal_terima', 'tanggal_aftap', 'tanggal_kadaluarsa', 'kode_darah', 'jenis_darah_golda', 'kode_pmi', 'nama_pmi', 'kode_kurir', 'nama_kurir', 'kode_penerima', 'nama_penerima']

            fields.forEach((e, i) => {
                const element = modal_form_detail.querySelector(`#${fields[i]}`);
                element.value = data[i];
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