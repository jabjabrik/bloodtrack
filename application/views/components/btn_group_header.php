<div class="btn-group btn-group-sm" role="group">
    <?php if (!isset($is_active_page) || $is_active_page): ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('tambah')">
            <i class="bi bi-plus-circle"></i> Tambah
        </button>
    <?php endif; ?>
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