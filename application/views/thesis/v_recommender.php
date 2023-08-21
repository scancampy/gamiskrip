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
              <li class="breadcrumb-item active">Topic Recommender</li>
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
                  <form method="post" action="<?php echo base_url('thesis/recommender'); ?>" enctype="multipart/form-data">
                    <div class="card card-primary card-outline">
                      <div class="card-body">
                        <?php if(empty($nilai) &&  empty($clusterinfo)) { ?>
                        <p class="card-text"> To begin, please provide your <strong>transcript</strong> first in order to give accurate and better recommendations for your thesis topic.
                          
                        </p>
                        <div class="form-group">
                          <label for="transcript_file">Transcript file</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="transcript_file" id="transcript_file">
                              <label class="custom-file-label" for="transcript_file">Choose file</label>
                            </div>
                            <div class="input-group-append">
                              <span class="input-group-text">Upload</span>
                            </div>
                          </div>
                        </div>
                       <?php } ?>  

                        <?php if(!empty($nilai)) { ?>
                        <div class="form-group">
                          <label>Choose 3 Courses</label>
                          <select class="select2bs4" name="courses[]" multiple="multiple" data-placeholder="Select three courses"
                                  style="width: 100%;">
                            <?php foreach ($nilai as $key => $value) { ?>
                              <option value="<?php echo $value['encoding']; ?>"><?php echo $value['nama'].' ('.$value['nilai'].')'; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      <?php } ?>

                      <?php if(!empty($clusterinfo)) { ?>
                        <div class="callout callout-info">
                          <h5>Cluster Info</h5>

                          <p>
                            <?php foreach ($selected_courses as $key => $value) { ?>
                              <span class="badge badge-primary"><?php echo $value->course_name; ?></span>
                            <?php } ?>
                            <?php echo '<br/><br/>'.$clusterinfo; ?></p>
                        </div>

                        <table class="table table-bordered table-striped table-hover" id="example2">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Title</th>
                              <th>Simmilarity Score</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($similarities as $key => $value) { ?>
                              <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $value['member']['title']; ?></td>
                                <td><?php echo round($value['similarity'],3); ?></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      <?php } ?>
                      </div>
                      <div class="card-footer">
                        <div class="row">
                          <?php if(empty($nilai) && empty($clusterinfo)) { ?>
                          <button type="submit" name="btnsubmit" value="submit" class="btn btn-primary">Submit</button>
                          <?php } ?>

                          <?php if(!empty($clusterinfo)) { ?>
                          <a href="<?php echo base_url('thesis/recommender'); ?>"  class="btn btn-primary">Start Over</a>
                          <?php } ?>


                          <?php if(!empty($nilai)) { ?>
                          <button type="submit" name="btnconfirm" value="submit" class="btn btn-primary">Confirm Courses</button>
                          <?php } ?>
                        </div>
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