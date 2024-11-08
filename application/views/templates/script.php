<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    // DataTables Config
    $(document).ready(function() {
        $('#datatables').DataTable({
            columnDefs: [{
                targets: 'no-sort',
                orderable: false
            }],
            "lengthMenu": [
                [5, 15, 25, -1],
                [5, 15, 25, 'All'],
                // [5, 25, 100],
                // [5, 25, 100]
            ],
            "language": {
                "lengthMenu": "_MENU_",
                "search": "Telusuri:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": ">",
                    "previous": "<"
                },
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
            }
        });
    });

    // Tooltip bootstrap
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>