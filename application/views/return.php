<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <form action="<?= base_url('Borrow/insertReturn') ?>" method="POST" id="formKembali">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <h2>Return Book</h2>
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="address">Book ID</label>
                <input type="text" class="form-control inputs" name="bookID" id="bookID" placeholder="Please insert Book ID" autofocus>
                <div class="help-block with-errors"></div>
              </div>
              <div id="formBookDetailKembali"></div>
            </div>
          </div>
        </div>
        <div class="col-md-4"></div>
      </div>
      <div class="row d-flex justify-content-center" id="divSubmit">
        <button class="btn btn-primary" id="btnSubmit">Return</button>
      </div>
  </div>
</section>
<script>
  $(function() {
    $('#bookID').keydown(function(e) {
      if (e.keyCode == 13 && $('#bookID').val()) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: '<?= base_url('Ajax/getBookDetailWithFine') ?>',
          data: {
            book: $('#bookID').val()
          },
          dataType: 'html',
          beforeSend: function() {
            $('#formBookDetailKembali').html("<img src = '<?= base_url('asset/image/loading.gif') ?>");
          },
          success: function(res) {
            if (res == 0) {
              swal({
                icon: "error",
                title: "Data doesn't exists",
                button: "Ok"
              }).then(function() {
                $('#bookID').focus();
                $('#bookID').val("");
              });
            } else {
              $('#formBookDetailKembali').html(res);
            }
          }
        });
      }
    });
    $('#btnSubmit').click(function(e) {
      e.preventDefault();
      // Validate
      if (!$('#bookID').val()) {
        swal({
          icon: "error",
          title: "Please insert Book ID",
          button: "Ok"
        }).then(function() {
          $('#bookID').focus();
          $('#bookID').val("");
        });
      } else {
        $('#formKembali').submit();
      }
    });
  })
</script>