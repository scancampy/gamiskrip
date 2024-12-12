<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Leaderboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('leaderboard'); ?>">Leaderboard</a></li>
              
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
              <div class="container mt-1">
    <!-- Date Period -->
    <div class="row mb-4">
        <div class="col-12 text-center">
          <img src="<?php echo base_url('images/assets/leaderboard_icon.png'); ?>" style="max-width: 100px;" />
            <h3>Leaderboard<br/><small>Periode: <span id="start-date"><?php $periodeStart = new DateTime($periode->start_periode); echo $periodeStart->format('d-m-Y'); ?></span> - <span id="end-date"><?php $periodeEnd = new DateTime($periode->end_periode); echo $periodeEnd->format('d-m-Y'); ?></span></small></h3>
        </div>
    </div>

    <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card ">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3"></h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link  active" href="#activity" data-toggle="tab"><i class="fas fa-user"></i> Individual</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"><i class="fas fa-users"></i> Clan</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body" >
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                    <div class="mb-3 d-flex justify-content-end">
                      <form  method="get" action="<?php echo base_url('leaderboard#activity'); ?>" id="form_submit_individual">
                        <select id="month_individual" name="month_individual" class="form-control d-block">
                          <option value="all" >All Months</option>
                          <?php
                          while ($periodeStart < $periodeEnd) { ?>
                          <option value="<?php echo $periodeStart->format('Y-m-d'); ?>" <?php if($this->input->get('month_individual') == $periodeStart->format('Y-m-d')) { echo 'selected'; } ?>><?php echo $periodeStart->format('F Y'); ?></option>
                          <?php $periodeStart->modify('first day of next month'); } ?>
                        </select>
                      </form>
                    </div>
                    <table class="table table-striped table-bordered">
                      <thead class="table-dark">
                          <tr>
                              <th scope="col"><i class="fas fa-hashtag"></i> Rank</th>
                              <th scope="col"><i class="fas fa-user"></i> User</th>
                              <th scope="col" class="text-center"><i class="fas fa-trophy"></i> Points</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php 
                        if(count($individual) == 0) { ?>
                          <tr>
                            <td colspan="3" class="text-center">Data Empty</td>
                          </tr>
                        <?php }

                        foreach ($individual as $key => $value) { ?>
                          <tr <?php if($value->user_id == $userjson->id) { echo ' style="background-color:#f8f9fa; "';  } else { echo ' style="background-color: white;"'; } ?> >
                              <th scope="row" style="width:100px; vertical-align: middle;"><h5><?php echo $key+1; ?></h5></th>
                              <td class="d-flex align-items-center">
                                <?php if($value->avatar_image_url != '') { ?>
                                <div class="col-md-1">
                                  <div class="image mr-2 " id="sidebarpropic" style="width:3.1em; height: 3.1em; border-radius: 50%; 
                                           background: url('<?php if($value->avatar_image_url) { echo $value->avatar_image_url; } else { echo base_url('images/assets/propic_blank.jpg');  } ?>');  
                     background-size: <?php if($value->avatar_image_url) { ?> 270% <?php } else { ?> 120% <?php } ?>;
                                          background-position: center 20%;
                                          background-color: gray;
                              background-repeat: no-repeat;  " >
                                    
                                  </div>
                                </div>
                            <?php }  else { ?>
                              <img class="img-circle mr-2 img-bordered-sm" src="<?php echo base_url('images/assets/propic_blank.jpg');  ?>" style="max-width: 3.1em; max-height: 3.1em;" alt="user image">
                            <?php } ?>
                            <div class="d-flex flex-column ml-4">
                              <a href="<?php echo base_url('myprofile/'.$value->nrp); ?>">
                              <?php echo $value->first_name.' '.$value->last_name; ?></a><span>Member of <a href="<?php echo base_url('myclan/viewclan/'.$value->clanid.'/'.$value->namaclan); ?>"><?php echo $value->namaclan; ?></a></span>
                            </div>
                          </td>
                              <td class="text-center" style="vertical-align: middle;"><h5><?php echo $value->total_points; ?></h5></td>
                          </tr>
                        <?php } ?>                        
                      </tbody>
                  </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <div class="mb-3 d-flex justify-content-end">
                      <form method="get" action="<?php echo base_url('leaderboard#timeline'); ?>" id="form_submit_clan">
                        <select id="month_clan" name="month_clan" class="form-control d-block">
                          <option value="all">All Months</option>
                          <?php
                          $periodeStart = new DateTime($periode->start_periode);
                          while ($periodeStart < $periodeEnd) { ?>
                          <option value="<?php echo $periodeStart->format('Y-m-d'); ?>" <?php if($this->input->get('month_clan') == $periodeStart->format('Y-m-d')) { echo 'selected'; } ?>><?php echo $periodeStart->format('F Y'); ?></option>
                          <?php $periodeStart->modify('first day of next month'); } ?>
                        </select>
                      </form>
                    </div>

                    <table class="table table-striped table-bordered">
                      <thead class="table-dark">
                          <tr>
                              <th scope="col"><i class="fas fa-hashtag"></i> Rank</th>
                              <th scope="col"><i class="fas fa-users"></i> Clan</th>
                              <th scope="col" class="text-center"><i class="fas fa-trophy"></i> Total Points</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php 
                          if(count($clan) == 0) { ?>
                          <tr>
                            <td colspan="3" class="text-center">Data Empty</td>
                          </tr>
                        <?php  }
                         foreach ($clan as $key => $value) { ?>
                          <tr style="background-color: white;">
                              <th scope="row" style="width:100px; vertical-align: middle;"><h5><?php echo $key+1; ?></h5></th>
                              <td><a href="<?php echo base_url('myclan/viewclan/'.$value->clan_id.'/'.url_title($value->nama, '-', TRUE)); ?>"><img src="<?php echo base_url('images/assets/clan_'.$value->clan_id.'.jpg'); ?>" style="width:50px;"/>
                                <?php echo $value->nama; ?></a></td>
                              <td class="text-center" style="vertical-align: middle;"><h5><?php echo $value->total_points; ?></h5></td>
                          </tr>
                       <?php  } ?>
                          
                      </tbody>
                    </table>                    
                  </div>                  
                </div>
                <!-- /.tab-content -->
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
        <h5 class="modal-title" id="myModalLabel">Gamiskrip Leaderboard</h5>
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
            <p class="mb-0 onboarding-content" id="onboarding-content-1" >Leaderboard menampilkan perolehan poinmu dibandingkan teman-teman lain.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-2" style="display:none;"  >Kamu juga bisa lihat perolehan poinmu di leaderboard secara bulanan.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-3" style="display:none;" >Selain poin individu, kamu juga bisa lihat perolehan poin untuk clan.<br/>Have fun!</p>
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