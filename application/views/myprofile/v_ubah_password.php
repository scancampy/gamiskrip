<div class="col-9">
  <!-- About Me Box -->
  <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ubah Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="<?php echo base_url('myprofile/ubahpassword'); ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="oldpass">Password Lama</label>
                    <input type="password" class="form-control" id="oldpass" name="oldpass" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="newpass">Password Baru</label>
                    <input type="password" class="form-control" id="newpass" name="newpass" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="repass">Ulangi Password Baru</label>
                    <input type="password" class="form-control" id="repass" name="repass" placeholder="Password">
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="btnsubmit" value="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>        
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
          <!-- /.content-wrapper -->