<div class="modal fade" id="confirm_modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <?php $text_header = $type == 'delete' ? 'Penghapusan' : ($type == 'active' ?  'Nonaktifan' : 'Aktifkan') ?>
                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi <?= $text_header ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php $text_body = $type == 'delete' ? 'Menghapus' : ($type == 'active' ?  'Nonaktifkan' : 'Mengaktifkan') ?>
                <span>Apakah Anda yakin ingin <?= $text_body ?> data?</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <?php $text_btn = $type == 'delete' ? 'Hapus' : ($type == 'active' ?  'Nonaktif' : 'Aktifkan') ?>
                <a id="btn_confirm" type="button" class="btn btn-<?= $type == 'nonactive' ? 'primary' : 'danger'; ?>"><?= $text_btn ?></a>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Delete -->

<!-- Script Modal Delete -->
<script>
    const btn_delete_nonactive = document.querySelectorAll('#btn_delete_nonactive')
    const btn_confirm = document.querySelector('#btn_confirm')

    btn_delete_nonactive.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            btn_confirm.setAttribute('href', `<?= base_url("$url/") ?>${id}`);
        })
    })
</script>