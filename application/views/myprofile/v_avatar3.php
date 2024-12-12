<div class="col-9">
  <!-- About Me Box -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Ubah Avatar</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <iframe id="frame" class="frame" allow="camera *; microphone *; clipboard-write" style="width: 100%;
        height: 600px;
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Fira Sans,
            Droid Sans, Helvetica Neue, sans-serif;
        padding: 0px;
        font-size: 14px;
        border: none;" hidden></iframe>
          </div>
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

           <!-- The Modal -->
<div class="modal fade" id="onboarding-dialog" tabindex="-1" role="dialog" aria-labelledby="onboarding-dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Gamiskrip MyProfile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <div class="row">
          <!-- Image on the Left -->
          <div class="col-md-2">
            <img src="<?php echo base_url('images/assets/avatar.png'); ?>" class="img-fluid" alt="Image description">
          </div>
          <!-- Text on the Right -->
          <div class="col-md-10 d-flex align-items-center">
            <p class="mb-0 onboarding-content" id="onboarding-content-1" >Bikin asik dengan gayamu sendiri. Gunakan fasilitas ubah avatar untuk tampil sesuai dengan dirimu.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-2" style="display:none;"  >Gunakan menu <strong>Ubah Password</strong> untuk ganti passwordmu.<br/>Have fun!</p>
          </div>
        </div>
      </div>

      <!-- Modal Footer with "Next" Button -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="onboarding-next-button">Next</button>
      </div>
    </div>
  </div>
</div>