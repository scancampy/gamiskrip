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


          <div class="col-lg-12">
            <div class="callout callout-info">
              <h5>Before We Start</h5>

              <p>Please take your time to answer all 24 questions in this questionnaire. Your answers will help us to better understand your gaming preferences and motivations. This information will be used to create a more personalized gaming experience for you.</p>
            </div>

            <form method="post" action="<?php echo base_url('survey'); ?>">
              
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">User Type Questionnaire</h3>
                </div>
                <div class="card-body">
                  

                  <p class="card-text">
                    <ol>
                   <?php foreach ($survey as $key => $value) { ?>
                     <li><?php echo $value->question; ?></li> 
                    <ul class='likert'>
                      <?php for($i = 1; $i<=7; $i++) { ?>
                        <li>
                          <input type="radio" name="likert_<?php echo $value->id; ?>"  <?php echo (@$this->input->post('likert_'.$value->id) == $i) ?  "checked" : "" ;  ?> value="<?php echo $i; ?>">
                          <label><?php echo $i; ?></label>
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
           
          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->