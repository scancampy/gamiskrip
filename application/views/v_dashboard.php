<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content pt-5">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <div class="col-md-12 d-flex" style="min-height:700px;">

            <?php 
            $expression = array("happy", "lol", "sad", "scared", "rage");
            $pose = array("power-stance", "relaxed", "standing", "thumbs-up");
            // Pick a random word from the array
            $randomExpression = $expression[array_rand($expression)];
            $randomPose = $pose[array_rand($pose)];

            
            ?>
            <?php if($userjson->avatar_image_url != '') { ?>
            <div class="col-md-4" style="background: url('<?php echo $userjson->avatar_image_url; ?>?expression=<?php echo $randomExpression; ?>&pose=<?php echo $randomPose; ?>&camera=fit'); background-size: cover; background-repeat: no-repeat; width: 200%;  background-position: center; ">
            </div>
          <?php } ?>
            <div class="col-md-8">
              <div class="card card-primary">
                <div class="card-header ">
                  <h3 class="card-title">
                    Welcome, <?php echo $userjson->first_name.' '.$userjson->last_name;
 ?>!
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <?php if(count($thesis) >0) { ?>

                  <table class="table table-bordered table-striped" style="background-color:white;">
                    <tr class="bg-gray-dark color-palette" style="background: url('<?php echo base_url('images/assets/bg_grad4.png'); ?>'); background-position: center; background-repeat: no-repeat; background-size: cover; "><th>Waktu Tersisa</th></tr>
                    <tr>
                      <td>
                        <div>
                          <?php 


                          // Define your start and end time using DateTime
                          $startTime = new DateTime($thesis[0]->tanggal_st); // replace with your start time
                          $endTime = new DateTime($thesis[0]->tanggal_akhir_st);   // replace with your end time

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
                    <tr class="bg-gray-dark color-palette" style="background: url('<?php echo base_url('images/assets/bg_grad5.png'); ?>'); background-position: center; background-repeat: no-repeat; background-size: cover; "><th>Progress Skripsi Kamu</th></tr>
                    <?php $startDate = new DateTime($thesis[0]->tanggal_st); ?>

                    <tr>
                      <td>
                        <div>
                          <small id="act" class="d-flex justify-content-between position-relative" style="width: 100%; padding: 0 15px;">
                            
                            <?php  
                            foreach ($acts as $key => $value) { 
                              
                              ?>
                            <div class="d-flex align-items-center flex-column position-relative step-box <?php if($thesis[0]->progress >= $value->act_id) { echo 'bg-fuchsia color-palette'; } ?>">
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
                              $tanggalacts[0] = $thesis[0]->tanggal_st;
                              foreach ($acts as $key => $value) { 
                                if ($key >= 1) {
                                  $prevdate = new DateTime($tanggalacts[$key-1]);
                                  //echo $acts[$key-1]->duration.' months<br/>';
                                  $tanggalacts[$key] = $prevdate->modify('+'.$acts[$key-1]->duration.' months')->format('Y-m-d');
                                }
                              }

                             // print_r($tanggalacts);

                              foreach ($acts as $key => $value) { 
                                if($thesis[0]->progress == $value->act_id) { 
                                  $currentuseract = $value; 

                                  if($key+1 > count($acts)) { ?>
                                    <p class="mt-2">Selamat kamu sudah mencapai akhir perjalanan pengerjaan skripsimu! Good job!<a href="">selengkapnya</a>
                                  <?php } else {
                                    $t1 =  new DateTime();
                                    $t2 = new DateTime($tanggalacts[$key+1]);
                                    if($t1 > $t2) { ?>
<p class="mt-2">Your progress is currently in <?php echo $currentuseract->label; ?>. <strong> Keep going and progressing to reach <?php echo $acts[$key+1]->label; ?>!</strong> <a href="<?php echo base_url('tugasakhir/logbimbingan'); ?>">read more</a></p>
                                   <?php } else {
                                      $interval = $t2->diff($t1);
                                      // Convert the interval to seconds
                                      $seconds = ($interval->y * 365 * 24 * 60 * 60) + // years to seconds
                                                 ($interval->m * 30 * 24 * 60 * 60) +  // months to seconds
                                                 ($interval->d * 24 * 60 * 60) +       // days to seconds
                                                 ($interval->h * 60 * 60) +            // hours to seconds
                                                 ($interval->i * 60) +                 // minutes to seconds
                                                 $interval->s; 

                                    ?>
                                    <p class="mt-2">Your progress is currently in <?php echo $currentuseract->label; ?>. <strong>You have <?php echo formatTimeLeft($seconds); ?> left to reach <?php echo $acts[$key+1]->label; ?>. Keep going and progressing!</strong> <a href="<?php echo base_url('tugasakhir/logbimbingan'); ?>">read more</a></p> 
                                  <?php }

                                  // Array of motivational sentences
$motivational_sentences = [
    "Every word you write brings you one step closer to graduation—stay focused and keep pushing forward!",
    "Imagine the joy of holding your diploma; let that vision fuel your motivation to finish strong!",
    "Sticking to your schedule today means a brighter future tomorrow—your dream job is waiting!",
    "Remember, every late night and early morning is an investment in your future—you're building a career!",
    "Reward yourself for small victories along the way; each chapter completed is a step toward your success!",
    "Stay committed to your thesis, and soon you'll be walking across that stage, ready to take on the world!",
    "Think of your thesis as the key to unlocking exciting job opportunities—keep turning the pages!",
    "With determination and hard work, graduation will be here before you know it—stay the course!",
    "Every challenge you face now is preparing you for the job market—embrace the journey!",
    "Visualize your future: a fulfilling job, new adventures, and the pride of completing your thesis!"
];

// Get a random index from the array
$random_index = array_rand($motivational_sentences);

// Echo the random motivational sentence
echo "<blockquote><em>\"" . htmlspecialchars($motivational_sentences[$random_index]) . "\"</em></blockquote>";
                                    }

                                  break;
                                }
                              }
                            ?>
                            
                          <?php // print_r($acts); ?>
                          <?php // print_r($thesis); ?>
                        </div>
                      </td>
                      </tr>
                    </table>

                  <hr/>
                  <?php $timezone = new DateTimeZone('Asia/Jakarta'); ?>
                      <table class="table table-bordered table-striped" style="background-color:white;">
                        <tr style="background: url('<?php echo base_url('images/assets/bg_grad.png'); ?>'); background-repeat: no-repeat; background-size: cover; " class="bg-gray-dark color-palette">
                          <th>Quest Aktif Kamu</th>                         
                        </tr>
                        <?php foreach ($quest as $key => $value) { ?>
                        <tr>
                          <td class="d-flex align-items-center">
                            <?php if($value->quest_status == "finished") { ?>
                            <i class="far fa-check-circle fa-lg mr-2"></i><div><?php echo $value->quest_desc; ?></div>
                            <?php } else { ?>
                            <i class="far fa-circle fa-lg mr-2"></i><div><?php echo $value->quest_desc; ?></div>
                            <?php } ?>
                          </td>
                          
                        </tr>                      
                      <?php }  ?>
                      </table>
                    <?php } else { ?>
                      <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-info"></i> Oops!</h5>
                        Judul skripsimu belum ada, tambahkan dulu lewat menu <strong>Data Skripsi</strong> di samping.
                      </div>
                    <?php } ?>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
         
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- The Modal -->
<div class="modal fade" id="onboarding-dialog" tabindex="-1" role="dialog" aria-labelledby="onboarding-dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Welcome to Gamiskrip</h5>
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
            <p class="mb-0 onboarding-content" id="onboarding-content-1" >Selamat datang di Gamiskrip (Gamify your Skripsi). Sebuah platform untuk membantu kamu kerja skripsi dengan lancar dan semangat.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-2" style="display:none;" >Kamu sekarang berada di halaman dashboard, yang bisa kasih tahu kamu progress skripsi, dan quest yang aktif.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-3" style="display:none;"  >Selanjutnya silahkan berkesplorasi dengan mengunjungi menu-menu yang terdapat di sebelah kiri. Untuk mengubah password dan profil kamu, silahkan klik namamu di ujung kiri atas. <br/>Have fun!</p>
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