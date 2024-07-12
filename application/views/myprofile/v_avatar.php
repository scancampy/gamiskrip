<div class="col-9">
  <!-- About Me Box -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Ubah Avatar</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <p>Pilih avatar anda:</p>
      <div class="container">
        <div class="row">
        <?php foreach ($avatar_images as $key => $value) { ?>
          <div class="col-3 avatar_img_btn" avatarid="<?php echo $value->id; ?>" avatarlink="<?php echo base_url('uploads/avatars/'.$value->avatar); ?>" style="padding: 5px;" id="">
            <div style="background-image: url('<?php echo base_url('uploads/avatars/'.$value->avatar); ?>'); background-size: cover;
    background-repeat: no-repeat; height: 200px; width: 100%;"></div>
          </div>
        <?php } ?>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
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