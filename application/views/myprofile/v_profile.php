<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">My Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
            </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
          <!-- Main content -->
          <div class="content">
            <div class="container">
              <div class="row">
                <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center" id="propic" style="width:128px; height: 128px; border-radius: 50%; margin-left: auto; margin-right: auto;
                background: url('<?php echo base_url('uploads/avatars/'.$userjson->avatar_image_filename); ?>');  background-size: cover;
    background-repeat: no-repeat;  " >
                </div>

                <h3 class="profile-username text-center"><?php echo $info[0]->fullname; ?></h3>

                <a href="<?php echo base_url('myprofile/ubahavatar'); ?>" class="btn btn-block <?php if($this->uri->segment(2) == 'ubahavatar') { echo 'btn-primary'; } else { echo 'btn-outline-primary'; } ?>"><b>Ubah Avatar</b></a>

                <a href="#" class="btn btn-block btn-outline-primary"><b>Ubah Password</b></a>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          