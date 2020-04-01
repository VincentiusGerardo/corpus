<script>
  $(function() {
    // Select
    $('select').select2({
      theme: 'bootstrap4',
      placeholder: "Select a category",
    });

    // Initiate table
    $('#tableBooks').DataTable({
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

    // seperate buttons
    $('.dt-buttons button').removeClass('btn-secondary');
    $('.dt-buttons').removeClass('btn-group');

    var table = $('#tableBooks').DataTable();

    // Modal Update
    $('#tableBooks tbody').on('click', '#buttonEdit', function() {
      var data = table.row($(this).parents('tr')).data();
      var catID = 0;
      var bookStat = 0;
      if (data[6] === 'Anak') {
        catID = 0;
      } else if (data[6] === 'Remaja/Pemuda') {
        catID = 1;
      } else if (data[6] === 'Dewasa') {
        catID = 2;
      }
      if (data[11] === 'Available') {
        bookStat = 0;
      } else if (data[11] === 'Borrowed') {
        bookStat = 1;
      }
      $('#modalEdit .modal-title').text('Edit Book: ' + data[1]);
      $('#modalEdit .modal-body input[name="idBook"]').val(data[0]);
      $('#modalEdit .modal-body input[name="namaBook"]').val(data[1]);
      $('#modalEdit .modal-body input[name="namaPenulis"]').val(data[2]);
      $('#modalEdit .modal-body input[name="namaPenerbit"]').val(data[3]);
      $('#modalEdit .modal-body input[name="tahunTerbit"]').val(data[4]);
      $('#modalEdit .modal-body input[name="idKlasifikasi"]').val(data[5]);
      $('#modalEdit .modal-body #category').val(catID).trigger('change');
      $('#modalEdit .modal-body input[name="idISBN"]').val(data[7]);
      $('#modalEdit .modal-body input[name="price"]').val(data[8]).number();
      $('#modalEdit .modal-body input[name="serial"]').val(data[9]);
      $('#modalEdit .modal-body input[name="vol"]').val(data[10]);
      $('#modalEdit .modal-body #updateStat').val(bookStat).trigger('change');
      $('#modalEdit').modal('show');
    });

    // Modal Delete
    $('#tableBooks tbody').on('click', '#buttonDelete', function() {
      var data = table.row($(this).parents('tr')).data();
      var catID = 0;
      var bookStat = 0;
      if (data[6] === 'Anak') {
        catID = 0;
      } else if (data[6] === 'Remaja/Pemuda') {
        catID = 1;
      } else if (data[6] === 'Dewasa') {
        catID = 2;
      }
      if (data[11] === 'Available') {
        bookStat = 0;
      } else if (data[11] === 'Borrowed') {
        bookStat = 1;
      }
      $('#modalDelete .modal-title').text('Delete Book: ' + data[1]);
      $('#modalDelete .modal-body input[name="idBook"]').val(data[0]);
      $('#modalDelete .modal-body input[name="namaBook"]').val(data[1]);
      $('#modalDelete .modal-body input[name="namaPenulis"]').val(data[2]);
      $('#modalDelete .modal-body input[name="namaPenerbit"]').val(data[3]);
      $('#modalDelete .modal-body input[name="tahunTerbit"]').val(data[4]);
      $('#modalDelete .modal-body input[name="idKlasifikasi"]').val(data[5]);
      $('#modalDelete .modal-body input[name="idCategory"]').val(catID);
      $('#modalDelete .modal-body input[name="idISBN"]').val(data[7]);
      $('#modalDelete .modal-body input[name="price"]').val(data[8]);
      $('#modalDelete .modal-body input[name="serial"]').val(data[9]);
      $('#modalDelete .modal-body input[name="vol"]').val(data[10]);
      $('#modalDelete .modal-body input[name="statusBuku"]').val(bookStat);
      $('#modalDelete .modal-body h1').text('Are you sure to delete ' + data[1]);
      $('#modalDelete').modal('show');
    });
  });
</script>
<style>
  table td:first-child,
  table td:last-child,
  table td:nth-child(5),
  table td:nth-child(6),
  table td:nth-child(9),
  table td:nth-child(11),
  table td:nth-child(12),
  table td:nth-child(8) {
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

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="tableBooks" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Author Name</th>
                <th>Publisher Name</th>
                <th>Publication Year</th>
                <th>Classification ID</th>
                <th>Category</th>
                <th>ISBN</th>
                <th>Price</th>
                <th>Serial Number</th>
                <th>Vol</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($book as $b) { ?>
                <tr>
                  <td><?= $b->ID_Buku ?></td>
                  <td><?= $b->NamaBuku ?></td>
                  <td><?= $b->NamaPengarang ?></td>
                  <td><?= $b->NamaPenerbit ?></td>
                  <td><?= $b->TahunTerbit ?></td>
                  <td><?= $b->ID_Klasifikasi == '' ? '-' : $b->ID_Klasifikasi ?></td>
                  <td><?= $b->NamaKategori ?></td>
                  <td><?= $b->ID_ISBN == '' ? '-' : $b->ID_ISBN ?></td>
                  <td><?= number_format($b->UnitPrice,2) ?></td>
                  <td><?= $b->SerialNumber ?></td>
                  <td><?= $b->ID_Jilid ?></td>
                  <td><?= $b->FlagPinjam == 0 ? 'Available' : 'Borrowed' ?></td>
                  <td>
                    <button type="button" id="buttonEdit" class="btn btn-info btn-sm">Edit</button>
                    &nbsp;
                    <button type="button" id="buttonDelete" class="btn btn-warning btn-sm">Delete</button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<!-- Modals -->
<div class="modal fade" id="modalAdd">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header alert-info">
        <h4 class="modal-title">Add Book</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form class="form-horizontal" action="<?= base_url('Source/do/Book/addBook') ?>" method="POST">
          <div class="form-group row">
            <label for="idBook" class="col-sm-3 col-form-label">Book ID</label>
            <div class="col-sm-9">
              <input type="text" readonly class="form-control-plaintext" name="idBook" value="<?= $nextNum ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="namaBook" class="col-sm-3 col-form-label">Book Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="namaBook" placeholder="Book's Name" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="namaBook" class="col-sm-3 col-form-label">Author Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="namaPenulis" placeholder="Author's Name" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="namaBook" class="col-sm-3 col-form-label">Publisher Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="namaPenerbit" placeholder="Publisher's Name" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="namaBook" class="col-sm-3 col-form-label">Publication Year</label>
            <div class="col-sm-9">
              <input type="text" class="form-control numericOnly" name="tahunTerbit" placeholder="Publication Year [YYYY]" maxlength="4" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="namaBook" class="col-sm-3 col-form-label">Classification ID</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="idKlasifikasi" placeholder="Classification ID" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="hpBook" class="col-sm-3 col-form-label">Category</label>
            <div class="col-sm-9">
              <select class="form-control" style="width: 100%;" name="idCategory">
                <option></option>
                <?php foreach ($category as $c) { ?>
                  <option value="<?= $c->ID_Kategori ?>"><?= $c->NamaKategori ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="hpBook" class="col-sm-3 col-form-label">ISBN</label>
            <div class="col-sm-9">
              <input type="text" class="form-control numericOnly" name="idISBN" placeholder="ISBN [Numbers only]" maxlength="15" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="hpBook" class="col-sm-3 col-form-label">Price</label>
            <div class="col-sm-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp. </span>
                </div>
                <input type="text" class="form-control numericOnly rupiah" name="price" placeholder="Book's Price" required>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="hpBook" class="col-sm-3 col-form-label">Serial Number</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="serial" placeholder="Book's Serial Number" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="hpBook" class="col-sm-3 col-form-label">Volume</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" name="vol" placeholder="Book's Volume" min="0" required>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Edit -->
<div class="modal fade" id="modalEdit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header alert-info">
        <h4 class="modal-title">Edit </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form class="form-horizontal" action="<?= base_url('Source/do/Book/updateBook') ?>" method="POST">
          <div class="form-group row">
            <label for="idBook" class="col-sm-3 col-form-label">Book ID</label>
            <div class="col-sm-9">
              <input type="text" readonly class="form-control-plaintext" name="idBook">
            </div>
          </div>
          <div class="form-group row">
            <label for="namaBook" class="col-sm-3 col-form-label">Book Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="namaBook" placeholder="Book's Name" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="namaBook" class="col-sm-3 col-form-label">Author Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="namaPenulis" placeholder="Author's Name" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="namaBook" class="col-sm-3 col-form-label">Publisher Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="namaPenerbit" placeholder="Publisher's Name" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="namaBook" class="col-sm-3 col-form-label">Publication Year</label>
            <div class="col-sm-9">
              <input type="text" class="form-control numericOnly" name="tahunTerbit" placeholder="Publication Year [YYYY]" maxlength="4" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="namaBook" class="col-sm-3 col-form-label">Classification ID</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="idKlasifikasi" placeholder="Classification ID" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="hpBook" class="col-sm-3 col-form-label">Category</label>
            <div class="col-sm-9">
              <select class="form-control" style="width: 100%;" name="idCategory" id="category">
                <option></option>
                <?php foreach ($category as $c) { ?>
                  <option value="<?= $c->ID_Kategori ?>"><?= $c->NamaKategori ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="hpBook" class="col-sm-3 col-form-label">ISBN</label>
            <div class="col-sm-9">
              <input type="text" class="form-control numericOnly" name="idISBN" placeholder="ISBN [Numbers only]" maxlength="15" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="hpBook" class="col-sm-3 col-form-label">Price</label>
            <div class="col-sm-9">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp. </span>
                </div>
                <input type="text" class="form-control numericOnly rupiah" name="price" placeholder="Book's Price" required>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="hpBook" class="col-sm-3 col-form-label">Serial Number</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="serial" placeholder="Book's Serial Number" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="hpBook" class="col-sm-3 col-form-label">Volume</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" name="vol" placeholder="Book's Volume" min="0" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="hpBook" class="col-sm-3 col-form-label">Book Status</label>
            <div class="col-sm-9">
              <select class="form-control" style="width: 100%;" name="statusBuku" id="updateStat">
                <option></option>
                <option value="0">Available</option>
                <option value="1">Borrowed</option>
              </select>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Delete -->
<div class="modal fade" id="modalDelete">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header alert-info">
        <h4 class="modal-title">Delete </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form class="form-horizontal" action="<?= base_url('Source/do/Book/deleteBook') ?>" method="POST">
          <input type="hidden" name="idBook">
          <input type="hidden" name="namaBook">
          <input type="hidden" name="namaPenulis">
          <input type="hidden" name="namaPenerbit">
          <input type="hidden" name="idBook">
          <input type="hidden" name="tahunTerbit">
          <input type="hidden" name="hpBook">
          <input type="hidden" name="idKlasifikasi">
          <input type="hidden" name="idCategory">
          <input type="hidden" name="idISBN">
          <input type="hidden" name="price">
          <input type="hidden" name="serial">
          <input type="hidden" name="vol">
          <input type="hidden" name="statusBuku">
          <h1>Are you sure to delete </h1>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>