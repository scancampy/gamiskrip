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
            <?php echo $infobox; ?>
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
                        } ?>
                      <?php echo $jumlahplanselesai; ?>/<?php echo $jumlahplan; ?> Rencana kegiatan selesai</span>
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