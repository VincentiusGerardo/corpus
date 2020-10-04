<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <form action="<?= base_url('Borrow/insertBorrow') ?>" method="POST" id="formPinjam">
      <input type="hidden" name="tPinjam" id="inputTPinjam" />
      <input type="hidden" name="tKembali" id="inputTKembali" />
      <div class="row">
        <div class="col-md-4">
          <h2>Member Information</h2>
          <div class="card" style="height: 325px;">
            <div class="card-body">
              <?php $this->load->view('subform/memberselect.php'); ?>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <h2>Book Details</h2>
          <div class="card" style="height: 325px;">
            <div class="card-body">
              <?php $this->load->view('subform/bookselect1.php') ?>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <h2>Book Details</h2>
          <div class="card" style="height: 325px;">
            <div class="card-body">
              <?php $this->load->view('subform/bookselect2.php') ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row d-flex justify-content-center" id="divSubmit">
        <button class="btn btn-primary" id="btnSubmit">Borrow</button>
      </div>
  </div>
</section>
<script>
  $(function() {
    $('#member').focus();
    $('#btnSubmit').click(function(e) {
      e.preventDefault();
      // Validate
      if (!$('#member').val()) {
        swal({
          icon: "error",
          title: "Please Insert Member ID",
          button: "Ok"
        }).then(function() {
          $('#member').focus();
          $('#member').val("");
        });
      } else if (!$('#book1').val()) {
        swal({
          icon: "error",
          title: "Please Insert 1st Book Details",
          button: "Ok"
        }).then(function() {
          $('#book1').focus();
          $('#book1').val("");
        });
      } else {
        $("#inputTPinjam").val(moment().format('YYYY-MM-DD'));
        $("#inputTKembali").val(moment().add(2, 'w').format('YYYY-MM-DD'));
        $('#formPinjam').submit();
      }
    });
  })
</script>