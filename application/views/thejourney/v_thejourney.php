<style>
  /* Apply this to all storydiv elements */
.storydiv {
  position: relative; /* Required for the pseudo-elements */
  margin-bottom: 20px; /* Add some space between the buttons */
}

/* The vertical line connecting each .storydiv */
.storydiv::before {
  content: "";
  position: absolute;
  top: 0; /* Align to the top of the .storydiv */
  left: 50%; /* Center the line horizontally */
  width: 2px; /* Thickness of the vertical line */
  height: 100%; /* Full height of the container */
  background-color: #ccc; /* Color of the vertical line */
  z-index: -1; /* Ensure it's behind the content */
}

/* Extend the line beyond the button until the next .storydiv */
.storydiv:not(:last-child)::after {
  content: "";
  position: absolute;
  top: 100%; /* Start from the bottom of the .storydiv */
  left: 50%; /* Align it with the previous line */
  width: 2px; /* Same thickness as the ::before line */
  height: 25px; /* Distance between the buttons */
  background-color: #ccc; /* Same color as the vertical line */
  z-index: 0;
}

/* Special case for the first .storydiv */
.storydiv:first-child::before {
  top: 50%; /* Start the line in the middle, since there's no element above */
}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">The Journey  <?php if($ta[0]->thejourney_character_id != null) { echo "- ".$journey_character[0]->name;  } ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('leaderboard'); ?>">The Journey</a></li>
              
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
                <div class="col-sm-4 col-md-2">
                  <h6 class="text-center bg-lightblue p-2">Point Anda: <?php 
                  if(count($points) > 0) {
                    $points_label = $points[0]->total_points; 
                    echo $points[0]->total_points;
                  } else {
                    $points_label = 0;
                    echo "0";
                  }

                  
                 //$points_label = 200;
                   ?></h6>                
                </div>
                <div class="col-md-12 text-center storydiv">
                  <button type="button" class="btn btn-block btn-outline-primary col-md-2 ml-auto mr-auto">
                  <?php if($ta[0]->thejourney_character_id == null) { ?>
                  Start The Journey
                  <?php } else { ?>
                    Journey Started
                  <?php } ?>
                  </button>
                </div>

                <?php if($ta[0]->thejourney_character_id == null) { ?>
                <div class="col-md-12 text-center mt-4 storydiv">
                  <button type="button"  data-toggle="modal" data-target="#imageSelectionModal" class="btn btn-block btn-outline-secondary btn-xs col-md-2 ml-auto mr-auto">Pilih Karakter</button>
                </div>
                <?php } ?>

                <?php // print_r($master_journey); ?>

                <?php 
                $actceck = null;
                $actprogress = null;
                foreach ($master_journey as $key => $value) { ?>
                  <?php

                  if($value->act_id != $actceck) {
                    if($actceck != $value->act_id) {
                      foreach ($master_act as $act) {
                        if (isset($act->act_id) && $act->act_id == $value->act_id) {
                          echo '<div class="col-md-12 text-center mt-4 storydiv">
                  <button type="button" class="btn btn-block btn-outline-primary col-md-2 ml-auto mr-auto disabled">'.$act->label.'</button>
                </div>';      
                          $actprogress = $act;
                                break;
                        }
                      }

                     $actceck = $value->act_id;

                    }
                    

                    /*if($actceck == null) {
                      echo '<div class="col-md-12 text-center mt-4 storydiv">
                  <button type="button" class="btn btn-block btn-outline-primary col-md-2 ml-auto mr-auto disabled">Wrap Up</button>
                </div>';
                    } else {
                      echo '<div class="col-md-12 text-center mt-4 storydiv">
                  <button type="button" class="btn btn-block btn-outline-primary col-md-2 ml-auto mr-auto disabled">End of Act '.$actceck.'</button>
                </div>';
                    }*/
                    
                  }

                    // cek id story ada atau nggak
                    $showStory = false;
                  //  print_r($journey);
                    foreach ($journey as $keyj => $valuej) {
                      //print_r($valuej);
                      if($valuej->thejourney_id == $value->id) {
                        $showStory = true;
                        break;
                      }
                    } 
                  ?>
                   <?php if($showStory == false) { ?>
                  <div class="col-md-12 text-center mt-4 storydiv">
                    <?php if($points_label < $value->min_points || $ta[0]->progress < $value->act_id) {          ?>
                    <button type="button" class="btn btn-block btn-outline-secondary btn-xs col-md-5 ml-auto mr-auto disabled">Story #<?php echo $key+1; ?><br/>(Reach <?php echo $value->min_points.' point to unlock'; ?> and your progress must at least reach <?php echo $actprogress->label; ?>)</button>
                  <?php } else { ?>
                    <button type="button" class="btn btn-block btn-outline-info btn-xs col-md-2 ml-auto mr-auto  revealstorybtn" storyid="<?php echo $value->id; ?>">Story #<?php echo $key+1; ?></button>
                  <?php } ?>
                  </div>
                <?php } ?>

                  
                  <?php if($showStory == true) { ?>
                   <div class="col-md-12 text-center mt-4 storydiv" id="card_<?php echo $value->id; ?>" >
                    <div class="card">
                      <div class="card-body p-0 bg-gray color-palette">
                        <div class="row">
                          <div class="col-md-5 col-sm-12 col-xs-12">
                            <img src="<?php echo base_url('images/assets/'.$value->story_image_filename); ?>" class="img-fluid" />
                          </div>
                          <div class="col-md-7 col-sm-12 col-xs-12 text-left" style="padding:40px;">
                            <h6><strong><?php echo $value->story_name; ?></strong></h6>
                            <?php echo $value->story_content; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="col-md-12 text-center mt-4 storydiv" id="card_<?php echo $value->id; ?>" style="display: none;" >
                    <div class="card">
                      <div class="card-body p-0 bg-gray color-palette">
                        <div class="row">
                          <div class="col-md-5 col-sm-12 col-xs-12">
                            <img src="<?php echo base_url('images/assets/'.$value->story_image_filename); ?>" class="img-fluid" />
                          </div>
                          <div class="col-md-7 col-sm-12 col-xs-12 text-left" style="padding:40px;">
                            <h6><strong><?php echo $value->story_name; ?></strong></h6>
                            <?php echo $value->story_content; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>

                <?php } ?>

                
                <div class="col-md-12 text-center mt-4 storydiv mb-4">
                  <button type="button" class="btn btn-block btn-outline-primary col-md-2 ml-auto mr-auto disabled">The End</button>
                </div>
              </div>
            </div>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->

          <!-- Modal -->
<div class="modal fade" id="imageSelectionModal" tabindex="-1" aria-labelledby="imageSelectionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageSelectionModalLabel">Pilih Karakter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('thejourney'); ?>">
          <div class="row">
            <?php foreach ($characters as $key => $value) { ?>
             <div class="col-3 ">
              <div class="card">
                <img src="<?php echo base_url('images/assets/'.$value->image_filename); ?>" class="card-img-top img-fluid" alt="Image 1">
                <div class="card-body">
                  <h5 class="card-title"><strong><?php echo $value->name; ?></strong></h5>
                  <p class="card-text"><small><?php echo $value->description; ?></small></p>
                  <button type="submit" class="btn btn-block bg-gradient-secondary" value="<?php echo $value->id; ?>" name="btnpilchar" data-bs-dismiss="modal">Pilih <?php echo $value->name; ?></button>
                </div>
              </div>
            </div>
           <?php } ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="onboarding-dialog" tabindex="-1" role="dialog" aria-labelledby="onboarding-dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Gamiskrip The Journey</h5>
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
            <p class="mb-0 onboarding-content" id="onboarding-content-1" >Ikuti kisah epic karakter pilihanmu di <strong>the Journey</strong>.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-2" style="display:none;"  >Mulai dengan klik tombol <strong>Pilih Karakter</strong>. Pilih salah satu dari empat epic story yang disediakan.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-3" style="display:none;" >Perolehan poinmu setelah menyelesaikan quest dapat digunakan untuk mengunlock epic story The Journey.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-4" style="display:none;"  >Namun selain poin, kamu juga harus meningkatkan progress <strong>"ACT"</strong> skripsimu agar bisa mengunlock story lebih lanjut lagi.<br/>Have fun!</p>
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

