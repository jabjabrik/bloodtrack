 <!-- Modal Delete -->
 <div class="modal fade" id="modal_delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Penghapusan</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 Apakah Anda yakin ingin menghapus data?
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                 <a id="confirm-delete" type="button" class="btn btn-danger">Hapus</a>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal Delete -->

 <!-- Script Modal Delete -->
 <script>
     const deleteButton = document.querySelectorAll('#delete-btn')
     const confirmDelete = document.querySelector('#confirm-delete')

     deleteButton.forEach(button => {
         button.addEventListener('click', () => {
             const id = button.getAttribute('data-id');
             confirmDelete.setAttribute('href', `<?= base_url("$name/") ?>${id}`)
         })
     })
 </script>
 <!-- End Script Modal Delete -->