<script>
    $(function(){
        // Initiate table
        $('#tableMember').DataTable({
            "paging": true,
            "searching": true,
            "lengthChange": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "columnDefs": [
              { "orderable": false, "targets": 4 }
            ],
            buttons: [
                {
                    text: '<i class="fas fa-plus"></i> Add Member',
                    className: "btn btn-primary",
                    action: function () {
                      $('#modalAdd').modal('show');
                    }
                },
                {
                    text: '<i class="fas fa-file-excel"></i> Export to Excel',
                    title: 'Member Perpustakaan GKI HI ' + moment().format('DD MMMM YYYY HH.mm.ss'),
                    extend: 'excelHtml5',
                    className: 'btn-success',
                    exportOptions: {
                        columns: [ 0,1,2,3 ]
                    }
                },
                {
                    text: '<i class="fas fa-file-pdf"></i> Export to PDF',
                    extend: 'pdfHtml5',
                    title: 'Member Perpustakaan GKI HI ' + moment().format('DD MMMM YYYY HH.mm.ss'),
                    className: 'btn-danger',
                    exportOptions: {
                        columns: [ 0,1,2,3 ]
                    }
                },
                {
                    text: '<i class="fas fa-print"></i> Print',
                    extend: 'print',
                    className: 'btn-default',
                    exportOptions: {
                        columns: [ 0,1,2,3 ]
                    }
                }
            ],
            dom: 
            "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        });

        // seperate buttons
        $('.dt-buttons button').removeClass('btn-secondary');
        $('.dt-buttons').removeClass('btn-group');

        var table = $('#tableMember').DataTable();

        // Modal Update
        $('#tableMember tbody').on('click','#buttonEdit', function(){
          var data = table.row( $(this).parents('tr') ).data();
          $('#modalEdit .modal-title').text('Edit ' + data[1]);
          $('#modalEdit .modal-body input[name="idMember"]').val(data[0]);
          $('#modalEdit .modal-body input[name="namaMember"]').val(data[1]);
          $('#modalEdit .modal-body input[name="hpMember"]').val(data[2]);
          $('#modalEdit .modal-body textarea').text(data[3]);
          $('#modalEdit').modal('show');
        });

        // Modal Delete
        $('#tableMember tbody').on('click','#buttonDelete', function(){
          var data = table.row( $(this).parents('tr') ).data();
          $('#modalDelete .modal-title').text('Delete ' + data[1]);
          $('#modalDelete .modal-body input[name="idMember"]').val(data[0]);
          $('#modalDelete .modal-body input[name="namaMember"]').val(data[1]);
          $('#modalDelete .modal-body input[name="hpMember"]').val(data[2]);
          $('#modalDelete .modal-body input[name="alamatMember"]').val(data[3]);
          $('#modalDelete .modal-body h1').text('Are you sure to delete ' + data[1]);
          $('#modalDelete').modal('show');
        });
    });
</script>
<style>
  table td:first-child, table td:nth-child(3), table td:last-child{
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
          <table id="tableMember" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>Member Name</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach($member as $m){ ?>
                <tr>
                  <td><?= $m->ID_Member ?></td>
                  <td><?= $m->NamaMember ?></td>
                  <td><?= $m->NoHP ?></td>
                  <td><?= $m->Alamat ?></td>
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
        <h4 class="modal-title">Add Member</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form class="form-horizontal" action="<?= base_url('Source/do/Member/addMember') ?>" method="POST">
        <div class="form-group row">
          <label for="idMember" class="col-sm-3 col-form-label">Member ID</label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control-plaintext" name="idMember" value="<?= $nextNum ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="namaMember" class="col-sm-3 col-form-label">Member Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="namaMember" placeholder="Member's Name" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="hpMember" class="col-sm-3 col-form-label">Phone Number</label>
          <div class="col-sm-9">
            <input type="text" class="form-control numericOnly" name="hpMember" placeholder="Member's Phone Number [Numbers only]" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="alamatMember" class="col-sm-3 col-form-label">Member Address</label>
          <div class="col-sm-9">
            <textarea class="form-control" rows="5" name="alamatMember" placeholder="Member's Address" required></textarea>
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
        <form class="form-horizontal" action="<?= base_url('Source/do/Member/updateMember') ?>" method="POST">
        <div class="form-group row">
          <label for="idMember" class="col-sm-3 col-form-label">Member ID</label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control-plaintext" name="idMember" >
          </div>
        </div>
        <div class="form-group row">
          <label for="namaMember" class="col-sm-3 col-form-label">Member Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="namaMember" placeholder="Member's Name" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="hpMember" class="col-sm-3 col-form-label">Phone Number</label>
          <div class="col-sm-9">
            <input type="text" class="form-control numericOnly" name="hpMember" placeholder="Member's Phone Number [Numbers only]" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="alamatMember" class="col-sm-3 col-form-label">Member Address</label>
          <div class="col-sm-9">
            <textarea class="form-control" rows="5" name="alamatMember" placeholder="Member's Address" required></textarea>
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
        <form class="form-horizontal" action="<?= base_url('Source/do/Member/deleteMember') ?>" method="POST">
        <input type="hidden" name="idMember">
        <input type="hidden" name="namaMember">
        <input type="hidden" name="hpMember">
        <input type="hidden" name="alamatMember">
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