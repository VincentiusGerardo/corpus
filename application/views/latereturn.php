<script>
  $(function() {
    // Initiate table
    $('#tableLateReturn').DataTable({
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
<style>
    table td:first-child,
    table td:last-child,
    table td:nth-child(4),
    table td:nth-child(5),
    table td:nth-child(6) {
        text-align: center;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tableLateReturn" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Member</th>
                                <th>Nama Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Total Hari Peminjaman</th>
                                <th>Total Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($lr as $l) { ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $l->NamaMember ?></td>
                                    <td><?= $l->NamaBuku ?></td>
                                    <td><?= date_format(date_create($l->TanggalPinjam), "d-m-Y") ?></td>
                                    <td><?= date_format(date_create($l->TanggalKembali), "d-m-Y") ?></td>
                                    <td><?= $l->TotalDays ?> Days</td>
                                    <td>Rp. <?= number_format($l->TotalDenda, 2) ?></td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>