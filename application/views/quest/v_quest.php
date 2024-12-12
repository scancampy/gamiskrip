<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Quest</h1>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('quest'); ?>">Quest</a></li>
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
                <div class="col-12">
                  <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Quest Berjalan</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body" style="display: block; background: url(<?php echo base_url('images/assets/quest.jpg'); ?>); background-size: cover; padding-bottom:200px;">
                    <?php $timezone = new DateTimeZone('Asia/Jakarta'); ?>
                      <table class="table table-borderless table-striped" style="background-color:white;">
                        <tr>
                          <th>Deskripsi Quest</th>
                          <th>Status</th>
                          <th style="min-width: 100px;">Reward</th>
                        </tr>
                        <?php if(count($quest) >0) { foreach ($quest as $key => $value) { ?>
                        <tr>
                          <td class="d-flex align-items-center">
                            <?php if($value->quest_status == "finished") { ?>
                            <i class="far fa-check-circle fa-lg mr-2"></i><div><?php echo $value->quest_desc; ?></div>
                            <?php } else { ?>
                            <i class="far fa-circle fa-lg mr-2"></i><div><?php echo $value->quest_desc; ?></div>
                            <?php } ?>
                          </td>
                          <td><?php echo $value->number_of_repetition_done.'/'.$value->repeated_need;
                            if($value->repeated_by != '') {
                              $eligibleRepeat = false;
                              $reason_not_eligible ='';
                              // cek last repeated date
                              if($value->last_repeat_date != null) {

                                if($value->repeated_by == "weekly") {
                                  // die();
                                  $date = new DateTime($value->last_repeat_date);
                                  // Find the Monday (start of the week)
                                  $startOfWeek = clone $date->modify('Monday this week');

                                  // Find the Sunday (end of the week)
                                  $endOfWeek = clone $date->modify('Sunday this week');
                                  $endOfWeek->setTime(23, 59, 0);  // Set time to 23:59:00

                                  // Get the current date and DateTime    
                                  $now = new DateTime('now', $timezone);

                                  // Compare if the current time is greater than $endOfWeek
                                  if ($now > $endOfWeek) {
                                    $eligibleRepeat = true;
                                   // die();
                                  } else {
                                    $reason_not_eligible = "Minggu ini kamu sudah melakukan misi ini.";
                                  }
                                } else if($value->repeated_by == "daily") {
                                  $now = new DateTime('now', $timezone);
                                  $date = new DateTime($value->last_repeat_date);
                                  $nowFormatted = $now->format('Y-m-d');   // Format as 'YYYY-MM-DD'
                                  $dateFormatted = $date->format('Y-m-d'); // Format as 'YYYY-MM-DD'

                                  if($nowFormatted != $dateFormatted) {
                                      $eligibleRepeat = true;
                                  } else {
                                      $eligibleRepeat = false;
                                      $reason_not_eligible = "Hari ini kamu sudah melakukan misi ini.";
                                  }
                                } else {
                                  $eligibleRepeat = true;
                                }
                               

                                if($eligibleRepeat == true) {
                                  echo " (".$value->repeated_by.") ";
                                } else {

                                  if($value->number_of_repetition_done < $value->repeated_need) {
                                    echo $value->repeated_by." (<strong>".$reason_not_eligible."</strong>) ";
                                  }
                                }
                              } else {
                                  echo " (".$value->repeated_by.") ";
                              }                              
                            }
                           ?></td>
                           <td class="text-right"><?php echo $value->repeated_need*$value->points; ?> point</td>
                        </tr>                      
                      <?php } } else { ?>
                        <tr>
                          <td colspan="3" class="text-center">Belum ada quest baru buat anda. Silahkan cek berkala</td>
                        </tr>
                      <?php }  ?>
                      </table>


                    </div>
                  <!-- /.card-body -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.content -->
          </div>
        </div>
          <!-- /.content-wrapper -->

<!-- The Modal -->
<div class="modal fade" id="onboarding-dialog" tabindex="-1" role="dialog" aria-labelledby="onboarding-dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Gamiskrip Quest</h5>
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
            <p class="mb-0 onboarding-content" id="onboarding-content-1" >Halaman ini berisi quest yang sedang aktif. Selesaikan quest agar kamu mendapatkan poin.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-2" style="display:none;"  >Terdapat dua tipe quest: 1) Quest yang dapat diselesaikan langsung; 2) Quest yang harus diselesaikan beberapa kali (mingguan, harian, atau sejumlah tertentu)</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-3" style="display:none;" >Poin yang kamu peroleh digunakan untuk rangking pemain. Lihat menu <strong>leaderboard</strong> untuk melihat peringkat poinmu dibandingkan teman-teman yang lain. </p>
            <p class="mb-0 onboarding-content" id="onboarding-content-4" style="display:none;"  >Poin juga dipakai untuk mengunlock cerita baru di menu <strong>"The Journey"</strong>.<br/>Have fun!</p>
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