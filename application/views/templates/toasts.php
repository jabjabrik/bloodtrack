<?php $toasts = $this->session->flashdata('toasts'); ?>
<?php if ($toasts) : ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast align-items-center text-bg-<?= $toasts['color'] ?> border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body text-white">
                    <?= $toasts['message'] ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toastElement = document.getElementById('liveToast');
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        });
    </script>
<?php endif; ?>