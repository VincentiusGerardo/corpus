  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    Copyright &copy; Perpustakaan GKI Harapan Indah 2016 - <?= date('Y') ?>. All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Template by <a href="http://adminlte.io">AdminLTE.io</a></b>
    </div>
  </footer>
  </div>
  <!-- ./wrapper -->

  <!-- Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('Login/doLogout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Change Password -->
  <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('Admin/Source/do/ChangePassword') ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $this->session->userdata('username') ?>">
            <div class="form-group">
              <label for="">Current Password</label>
              <input type="password" class="form-control" name="pass">
            </div>
            <div class="form-group">
              <label for="">New Password</label>
              <input type="password" class="form-control" name="passN">
            </div>
            <div class="form-group">
              <label for="">Repeat Password</label>
              <input type="password" class="form-control" name="passR">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  </body>

  </html>