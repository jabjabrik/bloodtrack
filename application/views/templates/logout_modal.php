<div class="modal fade" id="logout_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Yakin ingin keluar?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Pilih "Logout" bila anda ingin keluar dari sesi Anda.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</div>