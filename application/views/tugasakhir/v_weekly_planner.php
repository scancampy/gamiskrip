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
              <li class="breadcrumb-item active">Weekly Planner</li>
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
         <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Tugas Akhir</h3>
              </div>
      <!-- /.card-header -->
              <div class="card-body" style="display: block;">
                <dl>
                  <dt><?php echo $tugasakhir[0]->judul; ?></dt>
                  <dd><?php echo $tugasakhir[0]->f1; ?> &amp; <?php echo $tugasakhir[0]->f2; ?></dd>
                </dl>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Weekly Planner</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 532px;" width="1064" height="500" class="chartjs-render-monitor"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
        </div>

        <div class="row">
          <div class="col-lg-12"> 
          <div id="accordion">     
            <?php 
            $date = $tugasakhir[0]->tanggal_st; // format is Y-m-d
            $dateTime = new DateTime($date);
            $dateTime->modify('monday this week');    
            $mondayDate = $dateTime->format('Y-m-d');
          //  echo "The Monday of the week for the given date is: $mondayDate";

            //$day = date('w', strtotime($tugasakhir[0]->tanggal_st));
            //$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
            //$week_end = date('Y-m-d', strtotime('+'.(6-$day).' days')); 
           // echo $week_start.' '.$week_end;
            //print_r($tugasakhir);
            ?>

            <?php 
            $pekan = 1; 
            $dateAkhir = new DateTime($tugasakhir[0]->tanggal_akhir_st);

             while($dateTime < $dateAkhir) { ?>
              <div class="card">
                <div class="card-header 
                <?php 
                  $today = new DateTime();
                  $akhirpekan=  clone $dateTime;
                  $weekstart = clone $dateTime;
                  $akhirpekan->modify('+6 days');

                if($today->format('Y-m-d') >= $dateTime->format('Y-m-d') && $today->format('Y-m-d') <= $akhirpekan->format('Y-m-d')) { echo 'bg-warning'; } ?>" id="heading<?php echo $pekan; ?>">
                  <div class="row align-items-center ">
                    <div class="col-lg-1 col-sm-12 col-md-12 col-xs-12 text-center">
                      <a href="#" data-toggle="collapse" data-target="#collapse<?php echo $pekan; ?>" aria-expanded="true" aria-controls="collapse<?php echo $pekan; ?>">
                      <span>Pekan</span><br/>
                        <h3 ><?php echo $pekan; ?></h3>
                      </a>
                    </div>
                    <div class="col-10 ">
                      <a href="#" data-toggle="collapse" data-target="#collapse<?php echo $pekan; ?>" aria-expanded="true" aria-controls="collapse<?php echo $pekan; ?>"><strong><?php 
                      echo strftime('%d %B %Y', strtotime($dateTime->format('Y-m-d')));
                      $dateTime->modify('+6 days');
                      $weekend = clone $dateTime;
                      echo '-'.strftime('%d %B %Y', strtotime($dateTime->format('Y-m-d')));  ?></strong>
                      
                      <br/>
                      <span class="text-muted">
                        <?php 
                        $jumlahplan = 0;
                        $jumlahplanselesai = 0;

                        $renderweeklyplan = '';


                        if($weeklyplan != false) {
                          foreach ($weeklyplan as $key => $value) {
                            if($value->start_week == $weekstart->format('Y-m-d') && $value->end_week == $weekend->format('Y-m-d')) { 
                              $jumlahplan++;
                              $disablecheck = '';

                              if($value->is_done == true) {
                                $disablecheck = ' disabled checked';
                              }

                              $renderweeklyplan .= '<div class="row justify-content-between pb-2 pt-2" style="border-bottom: 1px solid lightgray;">
                            <span>'; 

                              if($value->is_done == false) {
                                $renderweeklyplan .= '<a href="" data-toggle="modal" id="plandisplay-'.$value->id.'" data-target="#modal-edit" class="editplan" idplan="'.$value->id.'">'.$value->plan.'</a></span><div>';
                              } else {
                                $renderweeklyplan .= $value->plan.'</span><div>';
                              }
                            

                              if($disablecheck == '') {
                                $renderweeklyplan .= '<i class="fas fa-trash text-muted plandel" idplan="'.$value->id.'" ></i>&nbsp;&nbsp;';
                              }
                              
                              $renderweeklyplan .= '<input type="checkbox" '.$disablecheck.' class="checkplan" idplan="'.$value->id.'"/> 
                              </div>
                            </div>';

                              if($value->is_done == 1) {
                                $jumlahplanselesai++;
                              }
                            }
                          }
                        } ?>
                      <?php echo $jumlahplanselesai; ?>/<?php echo $jumlahplan; ?> Rencana kegiatan selesai
                        <input type="hidden" id="jumlahplan_<?php echo $pekan; ?>" value="<?php echo $jumlahplan; ?>" >
                        <input type="hidden" id="jumlahplanselesai_<?php echo $pekan; ?>" value="<?php echo $jumlahplanselesai; ?>" >
                        </span>
                      </a>
                    </div>
                    <div class="align-middle">
                      <?php if($jumlahplanselesai >= $jumlahplan && $jumlahplan != 0) { ?>
                      <img style="width:40px;" src="<?php echo base_url('images/assets/trophy.png'); ?>"/>
                      <?php } else { ?>  
                      <img style="width:40px;" src="<?php echo base_url('images/assets/trophy_bw.png'); ?>"/>
                      <?php } ?>
                    </div>
                  </div>
                </div>

                <div id="collapse<?php echo $pekan; ?>" class="collapse" aria-labelledby="heading<?php echo $pekan; ?>" data-parent="#accordion">
                  <div class="card-body pt-0 " >
                    <div class="row justify-content-center " >
                      <div class="col-12 mb-2 renderplan-<?php echo $pekan; ?>">
                      <?php if($renderweeklyplan != '') { 
                       echo $renderweeklyplan;  } ?>
                      </div>
                      <div class="col-1 mt-2">
                        <a href="" data-toggle="modal" weekstart="<?php echo $weekstart->format('Y-m-d'); ?>" weekend="<?php echo $weekend->format('Y-m-d'); ?>" tugasakhirid="<?php echo $tugasakhir[0]->id; ?>" data-target="#modal-default" class="btn btn-primary btnplus" pekan="<?php echo $pekan; ?>"><i class="fas fa-plus"></i></a>
                      </div>
                     </div>
                  </div>
                </div>
              </div>
            
          <?php $pekan++; $dateTime->modify('+1 day'); } ?>
          </div>

          <input type="hidden" id="jumlahpekan" value="<?php echo $pekan; ?>">
        </div>

        </div>   

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('tugasakhir/weeklyplanner'); ?>">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Weekly Plan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="judul">Tulis Kegiatan</label>
            <input type="hidden" name="tugas_akhir_id" id="tugas_akhir_id" />
            <input type="hidden" name="week_start" id="week_start" />          
            <input type="hidden" name="week_end" id="week_end" />            
            <input type="hidden" name="pekan" id="pekan" />  
            <input type="text" class="form-control" required name="judul" id="judul" >
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" name="btnsubmit" id="btnsubmit" value="submit">Simpan</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        
        <div class="modal-header">
          <h4 class="modal-title">Edit Weekly Plan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="judul">Tulis Kegiatan</label>
            <input type="hidden" name="planid" id="planid" />
            <input type="text" class="form-control" required name="juduledit" id="juduledit" >
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" name="btnedit" id="btnedit" value="submit">Simpan</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <!-- The Modal -->
<div class="modal fade" id="onboarding-dialog" tabindex="-1" role="dialog" aria-labelledby="onboarding-dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Gamiskrip Weekly Planner</h5>
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
            <p class="mb-0 onboarding-content" id="onboarding-content-1" >Pakai weekly plan untuk membuat rencana mingguan kamu. Dengan membuat rencana mingguan, maka pengerjaan skripsimu lebih teratur.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-2" style="display:none;"  >Setelah rencana dibuat, jangan lupa mengerjakan sesuai rencana tersebut. Jika sudah selesai, maka kamu bisa memberi <strong>centang</strong> pada tugas yang kamu tulis di rencana mingguanmu itu.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-3" style="display:none;" >Dengan selalu mencatat dan melaksanakan rencana mingguan, maka kamu telah menciptakan habit yang baik agar skripsimu segera kelar.<br/>Have fun!</p>
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