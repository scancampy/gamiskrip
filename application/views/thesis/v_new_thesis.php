  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Thesis</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Input New Thesis Proposal</li>
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
            <form method="post" action="<?php echo base_url('thesis/inputthesis'); ?>" enctype="multipart/form-data"> 
              <div class="card card-primary card-outline">
                <div class="card-body">
                  <h5>Input New Thesis Proposal</h5>
                  <p class="card-text">
                    You need to provide a proposal file or google drive/dropbox link
                  </p>
                  <div class="form-group">
                    <label for="title">Thesis Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter title">
                  </div>

                  <div class="form-group">
                    <label for="proposal_file">Upload Proposal</label>
                    <input type="file" class="form-control" id="proposal_file" name="proposal_file" />
                  </div>

                  <div class="form-group">
                    <label for="proposal_link">Link Drive/Dropbox Proposal</label>
                    <input type="text" class="form-control" id="proposal_link" placeholder="Input link with public access" name="proposal_link" />
                  </div>

                  <div class="form-group">
                      <label for="lecturer1_npk">Choose 1st Supervisor</label>
                      <select class="form-control" name="lecturer1_npk" id="lecturer1_npk">
                        <?php foreach ($supervisor as $key => $value) { ?>
                          <option value="<?php echo $value->npk; ?>"><?php echo $value->name; ?></option>
                        <?php } ?>
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="lecturer2_npk">Choose 2nd Supervisor</label>
                      <select class="form-control" name="lecturer2_npk" id="lecturer2_npk">
                        <?php foreach ($supervisor as $key => $value) { ?>
                          <option value="<?php echo $value->npk; ?>"><?php echo $value->name; ?></option>
                        <?php } ?>
                      </select>
                  </div>

                  <div class="form-group">
                    <label for="start_date_in_sk">Start Date</label>
                    <input type="date" class="form-control" id="start_date_in_sk" name="start_date_in_sk" />
                    <small id="start_date_in_sk" class="form-text text-muted">Start date based on SK</small>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" name="btnsubmit" value="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
           
          </div>
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->