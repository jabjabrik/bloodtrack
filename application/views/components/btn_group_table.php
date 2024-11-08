<div class="btn-group btn-group-sm" role="group">
    <!-- DETAIL -->
    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('detail', <?= $params ?>)">
        <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-title="Detail data <?= $service_name ?>"></i>
    </button>
    <?php if (isset($is_active_page)): ?>
        <?php if ($is_active_page): ?>
            <!-- EDIT -->
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('edit', <?= $params ?>)">
                <i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-title="Edit data <?= $service_name ?>"></i>
            </button>
            <?php if ($service_name != 'darah'): ?>
                <!-- NONACTIVE -->
                <button id="btn_delete_nonactive" type="button" class="btn btn-outline-danger btn-sm" data-id="<?= $id ?>" data-bs-toggle="modal" data-bs-target="#confirm_modal">
                    <i class="bi bi-x-square" data-bs-toggle="tooltip" data-bs-title="Nonaktifkan <?= $service_name ?>"></i>
                </button>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (!$is_active_page): ?>
            <!-- ACTIVE -->
            <button id="btn_delete_nonactive" type="button" class="btn btn-outline-success btn-sm" data-id="<?= $id ?>" data-bs-toggle="modal" data-bs-target="#confirm_modal">
                <i class="bi bi-arrow-counterclockwise" data-bs-toggle="tooltip" data-bs-title="Aktifkan data <?= $service_name ?>"></i>
            </button>
        <?php endif; ?>
    <?php else: ?>
        <!-- EDIT -->
        <?php if ($service_name != 'penerimaan'): ?>
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_form" onclick="setForm('edit', <?= $params ?>)">
                <i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-title="Edit data <?= $service_name ?>"></i>
            </button>
        <?php endif; ?>
        <!-- DELETE -->
        <button id="btn_delete_nonactive" type="button" class="btn btn-outline-danger btn-sm" data-id="<?= $id ?>" data-bs-toggle="modal" data-bs-target="#confirm_modal">
            <i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-title="Hapus data <?= $service_name ?>"></i>
        </button>
    <?php endif; ?>

</div>