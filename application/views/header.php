
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Perpustkaan GKI Harapan Indah</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Header Application">
  <meta name="author" content="Vincentius Gerardo">

  <!-- jQuery -->
  <script src="<?= base_url('asset/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('asset/jquery/jquery.number.min.js') ?>"></script>

  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('asset/bootstrap/bootstrap.min.css') ?>">
  <script src="<?= base_url('asset/bootstrap/bootstrap.bundle.min.js') ?>"></script>

  <!-- AdminLTE App -->
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/css/adminlte.min.css') ?>">
  <script src="<?= base_url('asset/adminlte/js/adminlte.min.js') ?>"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('asset/fontawesome-free/css/all.min.css') ?>">

  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('asset/ionicons/ionicons.min.css') ?>">

  <!-- SmartWizard -->
  <link rel="stylesheet" href="<?= base_url('asset/SmartWizard/css/smart_wizard.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('asset/SmartWizard/css/smart_wizard_theme_dots.min.css') ?>">
  <script src="<?= base_url('asset/SmartWizard/js/jquery.smartWizard.min.js') ?>"></script>

  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('asset/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('asset/select2/css/select2.min.css') ?>">
  <script src="<?= base_url('asset/select2/js/select2.full.min.js') ?>"></script>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Sweetalert -->
  <script src="<?= base_url('asset/sweetalert/sweetalert.min.js') ?>"></script>

  <!-- Data Tables -->
  <link rel="stylesheet" href="<?= base_url('asset/datatables-bs4/css/dataTables.bootstrap4.css') ?>">
  <script src="<?= base_url('asset/datatables/jquery.dataTables.js') ?>"></script>
  <script src="<?= base_url('asset/datatables-bs4/js/dataTables.bootstrap4.js') ?>"></script>
  <link rel="stylesheet" href="<?= base_url('asset/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
  <script src="<?= base_url('asset/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
  <script src="<?= base_url('asset/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('asset/datatables-buttons/js/buttons.flash.min.js') ?>"></script>
  <script src="<?= base_url('asset/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
  <script src="<?= base_url('asset/datatables-buttons/js/buttons.print.min.js') ?>"></script>
  <script src="<?= base_url('asset/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>

  <!-- jszip for export to excel -->
  <script src="<?= base_url('asset/jszip/jszip.min.js') ?>"></script>

  <!-- pdfmake -->
  <script src="<?= base_url('asset/pdfmake/pdfmake.min.js') ?>"></script>
  <script src="<?= base_url('asset/pdfmake/vfs_fonts.js') ?>"></script>

  <!-- Moment --> 
  <script src="<?= base_url('asset/moment/moment.min.js') ?>"></script>

  <!-- Animate css -->
  <link rel="stylesheet" href="<?= base_url('asset/animate/animate.min.css') ?>">

  <!-- Custom script -->
  <link rel="stylesheet" href="<?= base_url('asset/css/style.css') ?>">
  <script src="<?= base_url('asset/js/script.js') ?>"></script>

  <!-- Alert for Success or Fail on action -->
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

</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i> <?= $this->session->userdata('fullname') ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
      <!-- <img src="../../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      <span class="brand-text font-weight-light">Perpustakaan GKI HI</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url('Module/') ?>" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Module/Books') ?>" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Books
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Module/Members') ?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Member
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Transactions
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Module/Loan') ?>" class="nav-link">
                  <i class="fas fa-upload nav-icon"></i>
                  <p>Borrow</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="fas fa-download nav-icon"></i>
                  <p>Return</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="fas fa-clock nav-icon"></i>
                  <p>Late Returns</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Module/Members') ?>" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Inventory Taking
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Module/History') ?>" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                History 
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">