<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">View Profile</h1>
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
                <div class="col-md-12 d-flex" style="min-height:700px;">

                    <?php 
                    $expression = array("happy", "lol", "sad", "scared", "rage");
                    $pose = array("power-stance", "relaxed", "standing", "thumbs-up");
                    // Pick a random word from the array
                    $randomExpression = $expression[array_rand($expression)];
                    $randomPose = $pose[array_rand($pose)];

                    
                    ?>
                    <?php if($user->avatar_image_url != '') { ?>
                    <div class="col-md-4" style="background: url('<?php echo $user->avatar_image_url; ?>?expression=<?php echo $randomExpression; ?>&pose=<?php echo $randomPose; ?>&camera=fit'); background-size: cover; background-repeat: no-repeat; width: 200%;  background-position: center; ">
                    </div>
                  <?php } ?>
                    <div>
                      <div class="d-flex">
                        <a href="<?php echo base_url('myclan/viewclan/'.$clan->id.'/'.url_title($clan->nama, '-', TRUE)); ?>">
                          <img src="<?php echo base_url('images/assets/clan_'.$clan->id.'.jpg'); ?>" style="width:50px; height: auto;"/>
                        </a>
                        <div class="d-flex flex-column pl-2">
                          <h3 class="m-0"><?php echo $student[0]->fullname; ?></h3> 
                          <small>Member of <a href="<?php echo base_url('myclan/viewclan/'.$clan->id.'/'.url_title($clan->nama, '-', TRUE)); ?>"><?php echo $clan->nama; ?></a></small>
                        </div>
                      </div>                  
                      <h5 class="text-muted mt-3">Judul Skripsi: <?php echo $tugasakhir[0]->judul; ?></h5>
                      
                      <p><strong>Supervisors:</strong> <?php echo $tugasakhir[0]->f1; ?> <?php echo '&amp; '.$tugasakhir[0]->f2; ?></p>
                      <hr/>
                      <h5>Achievements</h5>
                      <div class="d-flex">
                         <?php 

                    $timezone = new DateTimeZone('Asia/Jakarta'); 
                    foreach ($achievements as $key => $value) {
                      if($value != false) { ?>
                        <div class="col-md-2 mb-3 d-flex justify-content-center flex-column">
                          <img class="img-fluid" src="<?php echo base_url('images/assets/achievement_'.$value['achievement']->id.'.jpg'); ?>" />
                          <small class="text-center"><?php echo $value['achievement']->caption; ?></small>
                        </div>
                     <?php }                     
                    } ?>
                      </div>
                      <hr/>

                      <table class="table table-bordered table-striped" style="background-color:white;">
                    <tr class="bg-gray-dark color-palette" style="background: url('<?php echo base_url('images/assets/bg_grad_2.png'); ?>'); background-repeat: no-repeat; background-size: cover; " ><th>Progress Skripsi</th></tr>
                    <?php $startDate = new DateTime($tugasakhir[0]->tanggal_st); ?>

                    <tr>
                      <td>
                        <div>
                         

                         

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
                          <small id="act" class="d-flex justify-content-between position-relative" style="width: 100%; padding: 0 15px;">
                            
                            <?php  
                            foreach ($acts as $key => $value) { 
                              
                              ?>
                            <div class="d-flex align-items-center flex-column position-relative step-box <?php if($tugasakhir[0]->progress >= $value->act_id) { echo 'bg-fuchsia color-palette'; } ?>">
                              <span style="min-width: 55px; border:1px solid #f012be;  text-align: center;"><?php echo $value->label; ?></span>                              
                            </div>
                          <?php } ?>
                        
                          </small>
                          <?php // print_r($acts); ?>
                          <?php // print_r($thesis); ?>
                        </div>
                      </td>
                      </tr>
                    </table>

                    <hr/>

                    <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3"></h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link  active" href="#activity" data-toggle="tab"><i class="fas fa-user"></i> Timeline Post</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"><i class="fas fa-users"></i> Completed Quest</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                     <?php foreach ($timeline as $key => $value) { ?>
<div class="card">
  <div class="card-body">
    <div class="post">
  <div class="user-block d-flex mb-0">
    <?php if($user->avatar_image_url!="") { ?>
        <div class="img-circle img-bordered-sm" id="sidebarpropic" style="width:2.1em; height: 2.1em; border-radius: 50%; margin-left: auto; margin-right: auto;
      background: url('<?php echo $user->avatar_image_url; ?>?background=255,255,255');  background-size: 270%;
      background-position: center 20%;
      background-color: gray; margin-left:0px; margin-right:0px;
background-repeat: no-repeat;   " >

</div>
      
    <?php } else { ?>
      <img class="img-circle img-bordered-sm" src="<?php echo base_url('images/assets/propic_blank.jpg');  ?>" alt="user image">
    <?php } ?>

    <div class="d-flex flex-column">
      <div class="d-flex flex-row  align-items-center">
        <span class="username ml-3" >
         <?php echo $value->fullname; ?>
        </span>
        <span class="description" style="margin-left:15px !important;"><?php echo formatChatTimestamp($value->created); ?></span>
      </div>
      <div class="ml-3"><?php echo $value->content;  ?></div>
    </div>
    
  </div>

</div>
  </div>
</div>                  
                    <?php } ?>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
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
                  <!-- /.tab-pane -->
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
                    </div>
                </div>
                
              </div>
            </div>
          </div>
          