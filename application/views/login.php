
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Perpustkaan GKI Harapan Indah</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Login Page">
  <meta name="author" content="Vincentius Gerardo">
    
  <!-- jQuery -->
  <script src="<?= base_url('asset/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('asset/bootstrap/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('asset/adminlte/js/adminlte.min.js') ?>"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('asset/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('asset/ionicons/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/css/adminlte.min.css') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Sweetalert -->
  <script src="<?= base_url('asset/sweetalert/sweetalert.min.js') ?>"></script>
  
  <!-- For Login Error Alert  -->
  <script>
    <?php if($this->session->flashdata('alert') != null) { ?>
      $(function(){
        swal({
          icon: "<?= $this->session->flashdata('alert') ?>",
          title: "<?= $this->session->flashdata('msg') ?>",
          button: "Ok"
        });
      });
    <?php } ?>
  </script>

  <!-- Style for background -->
  <style>
    body{
      margin:0;
      background-image: url("<?= base_url('asset/image/background1.png') ?>") !important;
      /* background-color: #cccccc;
      height: 500px; */
      background-position: center !important;
      background-repeat: no-repeat !important;
      background-size: cover !important;
      position: relative !important;
    }
    .login-logo{
      color: white !important;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <strong>Perpustkaan GKI HI</strong>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

      <form action="<?= base_url('Login/doLogin') ?>" method="post">
        <div class="input-group mb-3">
        <input type="text" id="inputEmail" class="form-control" placeholder="Username" required="required" autofocus="autofocus" name="inputUser">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" name="inputPass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

</body>
</html>
