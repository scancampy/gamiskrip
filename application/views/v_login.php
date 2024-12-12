<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $setting->web_name; ?>  | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('dist/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css'); ?>">

  <style type="text/css">
    .login-page {
      background: url('/images/assets/rm380-10.jpg') !important;
      background-size: cover !important; /* Ensures the image covers the whole div */
      background-position: center !important; /* Centers the background image */
      background-repeat: no-repeat !important;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?php echo base_url(); ?>" class="h1"><img class="img-fluid" src="<?php echo base_url('images/assets/gamiskriplogo.png'); ?>"/></a>
    </div>
    <div class="card-body">
      <?php 
        if(@$notif == 'failed') { ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Peringatan!</h5>
        <?php echo $msg; ?>
      </div>
      <?php } else if(@$notif == 'success') { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-bullhorn"></i> Sukses!</h5>
        <?php echo $msg; ?>
      </div>
      <?php } ?>



      <p class="login-box-msg">Masukkan email dan password akun gamiskrip anda</p>

      <form action="<?php echo base_url(); ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4 offset-md-8">
            <button type="submit" value="submit" name="btnsignin" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <?php /*
      <p class="mb-1">
        <a href="#">Lupa password</a><br/>
        <a href="<?php echo base_url('newaccount'); ?>">Buat Akun</a>
      </p>
      */ ?>
      </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url('dist/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('dist/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('dist/js/adminlte.min.js'); ?>"></script>
</body>
</html>
