<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Achievements</h1>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('achievements'); ?>">Achievements</a></li>
              
            </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
          <!-- Main content -->
          <div class="content">
            <div class="row">
              <div class="container">
                <div class="card card-info">
                  <div class="card-header ">
                    <h3 class="card-title">Achievements</h3>
                  </div>
                  <div class="card-body">
                    <div class="container">
                      <div class="row">
                    <?php 

                    $timezone = new DateTimeZone('Asia/Jakarta'); 
                    foreach ($achievements as $key => $value) {
                      if($value != false) { ?>
                        <div class="col-md-2 mb-3 d-flex justify-content-center flex-column">
                          <img class="img-fluid" src="<?php echo base_url('images/assets/achievement_'.$value['achievement']->id.'.jpg'); ?>" />
                          <strong class="text-center"><?php echo $value['achievement']->caption; ?></strong>
                          <p class="text-center"><?php echo $value['achievement']->notes; ?><br/><em><small>(obtained <?php $x = new DateTime($value['obtained_date']); echo $x->format('d/M/Y'); ?>)</small></em></p>
                        </div>
                     <?php }  else { ?>
                        <div class="col-md-2 mb-3 d-flex justify-content-center flex-column">
                          <img class="img-fluid" src="<?php echo base_url('images/assets/locked.jpg'); ?>" />
                          <strong class="text-center">???</strong>
                        </div>
                    <?php }                    
                    } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>  
        </div>
              </div>
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
        <h5 class="modal-title" id="myModalLabel">Gamiskrip Achievements</h5>
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
            <p class="mb-0 onboarding-content" id="onboarding-content-1" >Achievement atau Lencana Digital menunjukkan pencapaianmu yang luar biasa.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-2" style="display:none;"  >Setiap achievement dapat diunlock dengan kondisi tertentu. Achievement juga otomatis dipajang di halaman profilmu sehingga dapat dilihat teman-teman.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-3" style="display:none;" >Berikut tantangannya: Bisakah kamu unlock semua achievement?<br/>Have fun!</p>
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