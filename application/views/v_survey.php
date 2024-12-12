  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Welcome to Gamiskrip</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
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


          <div class="col-lg-12 mb-5">
            <?php if(count($answers) == count($survey)) { ?>
            <div class="callout callout-success">
              <h5>Questionnaire Completed</h5>
              <p>Thank you for filling out the player type questionnaire. You can now use the Gamiskrip website to help speed up your final project work. Click on the dashboard to get started!</p>


            </div>
          <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-primary">Go to Dashboard</a><?php } else { ?>
            
            <div class="callout callout-info">

              <h5>Before We Start</h5>

              <p>Please take your time to answer all 24 questions in this questionnaire. Your answers will help us to better understand your gaming preferences and motivations. This information will be used to create a more personalized gaming experience for you.</p>
            </div>

            <form method="post" action="<?php echo base_url('survey'); ?>">
              
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Player Type Questionnaire</h3>
                </div>
                <div class="card-body">
                  

                  <p class="card-text">
                    <ol>
                   <?php foreach ($survey as $key => $value) { 
                    $answer = '';
                    foreach ($answers as $item) {
                        if ($item->hexad_questions_id == $value->id) {
                            $answer = $item->answer;
                            break;
                        }
                    }

                    ?>
                     <li><?php echo $value->item; ?></li> 
                    <ul class='likert'>
                      <?php for($i = 1; $i<=7; $i++) { 

                        ?>
                        <li>
                          <input type="radio" name="likert_<?php echo $value->id; ?>" id="likert_<?php echo $value->id; ?>_<?php echo $i; ?>"  <?php   echo ($answer == $i) ?  "checked" : "" ;  ?> value="<?php echo $i; ?>">
                          <label for="likert_<?php echo $value->id; ?>_<?php echo $i; ?>"><?php echo $i; ?></label>
                        </li>
                      <?php } ?>
                    </ul>
                    <div class="label_likert">
                      <strong>Strongly Disagree</strong>
                      <strong>Strongly Agree</strong>
                    </div>
                   <?php } ?>
                  </ol>
                  </p>

                </div>
                <div class="card-footer">
                  <button type="submit" value="submit" name="btnsubmit" class="btn btn-primary">Submit</button>
                </div>
            </div>

              </form>
            <?php } ?>
           
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
        <h5 class="modal-title" id="myModalLabel">Gamiskrip - Welcome to You</h5>
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
            <p class="mb-0 onboarding-content" id="onboarding-content-1" >Selamat datang di platform gamifikasi Gamiskrip. Platform ini bantu kamu kelarin skripsi lebih cepat.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-2" style="display:none;"  >Sebelum mulai pakai platform ini, mohon isi survey berikut dengan jawaban sejujur-jujurnya.<br/>Have fun!</p>
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