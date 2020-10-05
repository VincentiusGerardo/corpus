<?php if (count($res) == 0) { ?>
    0
<?php } else { ?>
    <table class="table table-bordered table-striped table-hover" id="tableHistory">
        <thead>
            <th>No.</th>
            <th>Description</th>
            <th>Created By</th>
            <th>Created On</th>
        </thead>
        <tbody>
        <?php $i = 1; foreach ($res as $r) { ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $r->HistoryDesc ?></td>
                <td><?= $r->CreatedBy ?></td>
                <td><?= date_format(date_create($r->CreatedDate), "d-m-Y H:i:s") ?></td>
            </tr>
        <?php $i++; } ?>
        </tbody>
    </table>
<?php } ?>
<script>
    $(function () { 
        $('#tableHistory').DataTable({
        "paging": true,
        "searching": true,
        "lengthChange": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "columnDefs": [{
            "orderable": false,
            "targets": 12
            },

        ],
        buttons: [{
            text: '<i class="fas fa-plus"></i> Add Book',
            className: "btn btn-primary",
            action: function() {
                $('#modalAdd').modal('show');
            }
            },
            {
            text: '<i class="fas fa-file-excel"></i> Export to Excel',
            title: 'Buku Perpustakaan GKI HI ' + moment().format('DD MMMM YYYY HH.mm.ss'),
            extend: 'excelHtml5',
            className: 'btn-success',
            exportOptions: {
                columns: [0, 1, 2, 3]
            }
            },
            {
            text: '<i class="fas fa-file-pdf"></i> Export to PDF',
            extend: 'pdfHtml5',
            title: 'Buku Perpustakaan GKI HI ' + moment().format('DD MMMM YYYY HH.mm.ss'),
            className: 'btn-danger',
            exportOptions: {
                columns: [0, 1, 2, 3]
            }
            },
            {
            text: '<i class="fas fa-print"></i> Print',
            extend: 'print',
            className: 'btn-default',
            exportOptions: {
                columns: [0, 1, 2, 3]
            }
            }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        });
    });
</script>