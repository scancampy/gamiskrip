 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tugas Akhir</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Progress</li>
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
<div class="col-md-12">
  <div class="card ">
    <div class="card-header d-flex p-0">
      <h3 class="card-title p-3"></h3>
      <ul class="nav nav-pills ml-auto p-2">
        <li class="nav-item"><a class="nav-link  active" href="#activity" data-toggle="tab"><i class="fas fa-user"></i> Student Progress</a></li>
        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"><i class="fas fa-users"></i> Completed Quest</a></li>
      </ul>
    </div><!-- /.card-header -->
    <div class="card-body" >
      <div class="tab-content">
        <div class="tab-pane active" id="activity">
          <dl>
        <dt><?php echo $tugasakhir[0]->judul; ?></dt>
        <dd>Mahasiswa: <?php echo $student[0]->fullname; ?></dd>
        <dd>Supervisor: <?php echo $tugasakhir[0]->f1; ?> &amp; <?php echo $tugasakhir[0]->f2; ?></dd>

        
      </dl>

      <hr/>

      <table class="table table-bordered table-striped" style="background-color:white;">
                    <tr class="bg-gray-dark color-palette" style="background: url('<?php echo base_url('images/assets/bg_grad4.png'); ?>'); background-position: center; background-repeat: no-repeat; background-size: cover; " ><th>Waktu Tersisa</th></tr>
                    <tr>
                      <td>
                        <div>
                          <?php 


                          // Define your start and end time using DateTime
                          $startTime = new DateTime($tugasakhir[0]->tanggal_st); // replace with your start time
                          $endTime = new DateTime($tugasakhir[0]->tanggal_akhir_st);   // replace with your end time

                          // Get the current time
                          $currentTime = new DateTime();

                          // Check if current time is out of bounds
                          if ($currentTime < $startTime) {
                              // Before the start time, so set the progress to 0%
                              $progress = 0;
                          } elseif ($currentTime > $endTime) {
                              // After the end time, so set the progress to 100%
                              $progress = 100;
                          } else {
                              // Calculate total duration between start and end time
                              $totalDuration = $startTime->diff($endTime)->s + 
                                               ($startTime->diff($endTime)->i * 60) + 
                                               ($startTime->diff($endTime)->h * 3600) + 
                                               ($startTime->diff($endTime)->days * 86400);

                              // Calculate elapsed time from start to current time
                              $elapsedTime = $startTime->diff($currentTime)->s + 
                                             ($startTime->diff($currentTime)->i * 60) + 
                                             ($startTime->diff($currentTime)->h * 3600) + 
                                             ($startTime->diff($currentTime)->days * 86400);

                              // Calculate the percentage of elapsed time
                              $progress = ($elapsedTime / $totalDuration) * 100;
                          }

                          // Ensure progress is between 0 and 100
                          $progress = max(0, min(100, $progress));
                          ?>
                          <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%">
                              </div>
                          </div>
                          <small class="d-flex justify-content-between">
                            <div class="d-flex  flex-column text-left">
                                <i class="fas fa-caret-up"></i>
                                <span style="min-width: 75px; border:1px solid gray; text-align: center;"><?php echo $startTime->format('d-m-Y'); ?></span>
                            </div>
                            <div><span>( <?php
// Calculate the difference between the two dates
$interval = $currentTime->diff($endTime);

// Convert the interval to seconds
$seconds = ($interval->y * 365 * 24 * 60 * 60) + // years to seconds
           ($interval->m * 30 * 24 * 60 * 60) +  // months to seconds
           ($interval->d * 24 * 60 * 60) +       // days to seconds
           ($interval->h * 60 * 60) +            // hours to seconds
           ($interval->i * 60) +                 // minutes to seconds
           $interval->s; 

                            echo formatTimeLeft($seconds); ?> )</span></div>
                            <div class="d-flex ms-auto flex-column text-right">
                                <i class="fas fa-caret-up"></i>
                                <span style="min-width: 75px; border:1px solid gray; text-align: center;"><?php echo $endTime->format('d-m-Y'); ?></span>
                              </div>
                          </small>
                        </div>
                      </td>
                      </tr>
                    </table>
                    <hr/>

                    <table class="table table-bordered table-striped" style="background-color:white;">
                    <tr class="bg-gray-dark color-palette" style="background: url('<?php echo base_url('images/assets/bg_grad5.png'); ?>'); background-position: center; background-repeat: no-repeat; background-size: cover; "><th>Progress Skripsi Mahasiswa</th></tr>
                    <?php $startDate = new DateTime($tugasakhir[0]->tanggal_st); ?>

                    <tr>
                      <td>
                        <div>
                          <small id="act" class="d-flex justify-content-between position-relative" style="width: 100%; padding: 0 15px;">
                            
                            <?php  
                            foreach ($acts as $key => $value) { 
                              
                              ?>
                            <div class="d-flex align-items-center flex-column position-relative step-box <?php if($tugasakhir[0]->progress >= $value->act_id) { echo 'bg-fuchsia color-palette'; } ?>">
                              <span style="min-width: 55px; border:1px solid #f012be;  text-align: center;"><?php echo $value->label; ?></span>                              
                            </div>
                          <?php } ?>
                        
                          </small>

                         

<!-- Add the CSS -->
<style>
    /* Create the line that connects the spans */
    small#act::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background-color: lightgray;
        z-index: 0;
    }

    /* Ensure the span elements stay above the line */
    .step-box {
        background-color: white;
        z-index: 1; /* Make sure the boxes are above the line */
    }
</style>

                        </div>
                        <div>
                            <?php 
                              $currentuseract = null;
                              $nextuseract = null;
                              $tanggalacts = array();
                              $tanggalacts[0] = $tugasakhir[0]->tanggal_st;
                              foreach ($acts as $key => $value) { 
                                if ($key >= 1) {
                                  $prevdate = new DateTime($tanggalacts[$key-1]);
                                  //echo $acts[$key-1]->duration.' months<br/>';
                                  $tanggalacts[$key] = $prevdate->modify('+'.$acts[$key-1]->duration.' months')->format('Y-m-d');
                                }
                              }

                             // print_r($tanggalacts);

                              foreach ($acts as $key => $value) { 
                                if($tugasakhir[0]->progress == $value->act_id) {  ?>
                                  <p class="mt-2">Progress mahasiswa saat ini adalah <strong><?php echo $value->label; ?></strong></p>

                                  <form method="post" action="<?php echo base_url('tugasakhir/student_progress/'.$tugasakhir[0]->student_id); ?>">
                                    <?php if($key < count($acts) -1) { ?>
                                    <button type="submit" value="Submit" name="btnsubmitact" class="btn btn-warning">Naikkan Progress ke <?php echo strtoupper($acts[$key+1]->label); ?></button>
                                  <?php } ?>
                                  </form>
                                  <?php
                                  $currentuseract = $value; 

                                  
                                  break;
                                }
                              }
                            ?>

                          <table class="table table-bordered table-striped mt-3">
                            <thead>
                              <tr>
                                <th>Fase</th>
                                <th>Due Date</th>
                                <th>Aktivitas</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($acts as $key => $value) { ?>
                                <tr <?php if($tugasakhir[0]->progress == $value->act_id) { echo 'class="bg-success color-palette"'; } ?>>
                                  <td><?php echo $value->label; ?></td>
                                  <td><?php $t = new DateTime($tanggalacts[$key]); echo $t->format('d-M-Y'); ?></td>
                                  <td><?php echo $value->keterangan; ?></td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                            
                          <?php // print_r($acts); ?>
                          <?php // print_r($thesis); ?>
                        </div>
                      </td>
                      </tr>
                    </table>
        </div>
        <div class="tab-pane active" id="timeline">
          <dl>
            <dt>Data Point</dt>
            <dd>Periode Semester: <?php 
                                      $date = new DateTime($periode->start_periode); 
                                      echo $date->format('d/m/Y');
                                      echo ' - ';
                                      $date = new DateTime($periode->end_periode); 
                                      echo $date->format('d/m/Y'); ?></dd>
            <dd>Total Point: 
              <?php $total = 0; 
                    foreach ($quest as $key => $value) {
                      $total += $value->quest_points; 
                    } 
                    echo $total; ?></dd>
            <dd>Total Quest Terselesaikan: <?php echo count($quest); ?></dd>
          </dl>

          <table class="table table-striped table-bordered" id="quest_table">
            <thead class="table-dark" >
                <tr>
                    <th ><i class="fas fa-hashtag"></i> Quest</th>
                    <th ><i class="fas fa-user"></i> Completed Date</th>
                    <th ><i class="fas fa-trophy"></i> Points</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($quest as $key => $value) { ?>
                <tr>
                  <td><?php echo $value->rendered_caption; ?></td>
                  <td><?php 
                  $date = new DateTime($value->quest_finished_date); 
                  echo $date->format('d/m/Y'); ?></td>
                  <td><?php echo $value->quest_points; ?></td>
                </tr>
              <?php } ?>                          
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /.card -->
</div>
</div>

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
        <h5 class="modal-title" id="myModalLabel">Gamiskrip Progress Skripsi</h5>
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
            <p class="mb-0 onboarding-content" id="onboarding-content-1" >Halaman progress ini menunjukkan progress pengerjaan skripsimu. Perhatikan waktu tersisa yang ditampilkan pada bagian atas.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-2" style="display:none;"  >Progress skripsimu dibagi menjadi empat fase, yakni Act1, 2, 3 dan Wrap Up.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-3" style="display:none;" >Setiap fase memiliki quest/aktivitas unik agar bantu kamu percepat skripsimu<br/>Have fun!</p>
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