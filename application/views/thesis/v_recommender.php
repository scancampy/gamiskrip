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
                <?php   
                  for($i = 0; $i <= 4; $i++) { 
                  if(!empty(${'result_cluster_'.$i})) { ?>
                    <div class="col-lg-12">
                          <div class="card card-primary card-outline">
                      <div class="card-body">
                        <h3>Cluster #<?php echo $i; ?> - Topic/Title Recommendation</h3>
                        <p>Nearest Courses in Cluster #<?php echo $i; ?></p>
                        <table class="table table-bordered table-striped table-hover" id="example2">
                          <thead>
                            <tr>
                              <th colspan="2">Cluster center 1 - <?php echo ${"cluster_center_".$i}->cluster_center_1; ?></th>
                              <th colspan="2">Cluster center 2 - <?php echo ${"cluster_center_".$i}->cluster_center_2; ?></th>
                              <th colspan="2">Cluster center 3 - <?php echo ${"cluster_center_".$i}->cluster_center_3; ?></th>
                            </tr>
                          </thead>
                          <?php $average = 0; ?>
                          <tbody>                            
                            <tr>
                              <td><?php echo ${'nearest_courses_in_'.$i}[0]->course_name; ?></td>
                              <td><?php
                                $mark = 'N/A';
                                foreach (${'result_cluster_'.$i} as $key => $value) {
                                  if($value->course_id == ${'nearest_courses_in_'.$i}[0]->course_id) { $mark =  $value->mark; $average+= $value->mark; break; 
                                  }
                                } 
                                echo $mark;
                               ?></td>
                              <td><?php echo ${'nearest_courses_in_'.$i}[2]->course_name; ?></td>
                              <td><?php
                                $mark = 'N/A';
                                foreach (${'result_cluster_'.$i} as $key => $value) {
                                  if($value->course_id == ${'nearest_courses_in_'.$i}[2]->course_id) { $mark =  $value->mark; $average+= $value->mark; break; 
                                  }
                                } 
                                echo $mark;
                               ?></td>
                               <td><?php echo ${'nearest_courses_in_'.$i}[4]->course_name; ?></td>
                              <td><?php
                                $mark = 'N/A';
                                foreach (${'result_cluster_'.$i} as $key => $value) {
                                  if($value->course_id == ${'nearest_courses_in_'.$i}[4]->course_id) { $mark =  $value->mark; $average+= $value->mark; break; 
                                  }
                                } 
                                echo $mark;
                               ?></td>
                            </tr>
                            <tr>
                              <td><?php echo ${'nearest_courses_in_'.$i}[1]->course_name; ?></td>
                              <td><?php
                                $mark = 'N/A';
                                foreach (${'result_cluster_'.$i} as $key => $value) {
                                  if($value->course_id == ${'nearest_courses_in_'.$i}[1]->course_id) { $mark =  $value->mark; $average+= $value->mark; break; 
                                  }
                                } 
                                echo $mark;
                               ?></td>
                               <td><?php echo ${'nearest_courses_in_'.$i}[3]->course_name; ?></td>
                              <td><?php
                                $mark = 'N/A';
                                foreach (${'result_cluster_'.$i} as $key => $value) {
                                  if($value->course_id == ${'nearest_courses_in_'.$i}[3]->course_id) { $mark =  $value->mark; $average+= $value->mark; break; 
                                  }
                                } 
                                echo $mark;
                               ?></td>
                               <td><?php echo ${'nearest_courses_in_'.$i}[5]->course_name; ?></td>
                              <td><?php
                                $mark = 'N/A';
                                foreach (${'result_cluster_'.$i} as $key => $value) {
                                  if($value->course_id == ${'nearest_courses_in_'.$i}[5]->course_id) { $mark =  $value->mark; $average+= $value->mark; break; 
                                  }
                                } 
                                echo $mark;
                               ?></td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="6" class="text-right"><strong>AVG: <?php echo number_format($average/6,2); ?></strong></td>
                            </tr>
                          </tfoot>                          
                        </table>

                        <div class="card card-primary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Cluster Member &amp; Student Grades</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="display: none;">
                <table class="table table-bordered table-striped table-hover" id="exampleX<?php echo $i; ?>">
                  <thead>
                    <tr>
                      <th>Thesis Title</th>
                      <th>Course 1</th>
                      <th>Grade 1</th>
                      <th>Course 2</th>
                      <th>Grade 2</th>
                      <th>Course 3</th>
                      <th>Grade 3</th>
                      <th>Averages</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach (${'cluster_member_mark_'.$i} as $key => $value) { 
                      //print_r($value);
                      ?>
                    <tr>
                      <td><?php echo $value->title; ?></td>
                      <td><?php echo $value->cname1; ?></td>
                      <td><?php echo $value->nilai1; ?></td>
                      <td><?php echo $value->cname2; ?></td>
                      <td><?php echo $value->nilai2; ?></td>
                      <td><?php echo $value->cname3; ?></td>
                      <td><?php echo $value->nilai3; ?></td>
                      <td><?php echo number_format(($value->nilai1+$value->nilai2+$value->nilai3)/ 3.0, 2); ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
                        
                  </div>
                </div>
              </div>
                  <?php }  ?>
                  
                <?php } ?>


                <?php if(!empty($result0)) { 
                        //print_r($result1);
                        ?>
                        <div class="col-lg-12">
                          <div class="card card-primary card-outline">
                      <div class="card-body">
                        <h3>Cluster #0 - Topic/Title Recommendation</h3>
                        <p>
                          Total course(s) in Cluster #0: <?php echo count($cluster_course_0); ?><br/>
                          Number of eligible courses(s): <?php echo $eligible_course_0; ?><br/>
                          Total topic/title in Cluster #0: <? echo count($cluster_result_0); ?><br/>
                          
                          Total recommendation results in Cluster #0: <?php echo count($result0); ?></p>
                      <table class="table table-bordered table-striped table-hover" id="example2">
                          <thead>
                            <tr>
                              <th>Title</th>
                              <th>Average Mark</th>
                              <th>Euclidean Distance to Center</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($result0 as $key => $value) { ?>
                              <tr>
                                <td><?php echo $value->title; ?></td>
                                <td><?php echo $value->averagenilai; ?></td>
                                <td><?php echo $value->distance; ?></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                      </div>
                       <?php } ?>

                       <?php if(!empty($result1)) { 
                        //print_r($result1);
                        ?>
                        <div class="col-lg-12">
                          <div class="card card-primary card-outline">
                      <div class="card-body">
                        <h3>Cluster #1 - Topic/Title Recommendation</h3>
                        <p>
                          Total course(s) in Cluster #1: <?php echo count($cluster_course_1); ?><br/>
                          Number of eligible courses(s): <?php echo $eligible_course_1; ?><br/>
                          Total topic/title in Cluster #1: <? echo count($cluster_result_1); ?><br/>

                          Total recommendation results in Cluster #1: <?php echo count($result1); ?></p>
<table class="table table-bordered table-striped table-hover" id="example3">
                          <thead>
                            <tr>
                              <th>Title</th>
                              <th>Average Mark</th>
                              <th>Euclidean Distance to Center</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($result1 as $key => $value) { ?>
                              <tr>
                                <td><?php echo $value->title; ?></td>
                                <td><?php echo $value->averagenilai; ?></td>
                                <td><?php echo $value->distance; ?></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>


                      </div>
                    </div>
                      </div>
                       <?php } ?>

                       <?php if(!empty($result2)) { 
                        //print_r($result1);
                        ?>
                        <div class="col-lg-12">
                          <div class="card card-primary card-outline">
                      <div class="card-body">
                        <h3>Cluster #2 - Topic/Title Recommendation</h3>
                        <p>
                          Total course(s) in Cluster #2: <?php echo count($cluster_course_2); ?><br/>
                          Number of eligible courses(s): <?php echo $eligible_course_2; ?><br/>
                          Total topic/title in Cluster #2: <? echo count($cluster_result_2); ?><br/>
                          
                          Total recommendation results in Cluster #2: <?php echo count($result2); ?></p>
<table class="table table-bordered table-striped table-hover" id="example4">
                          <thead>
                            <tr>
                              <th>Title</th>
                              <th>Average Mark</th>
                              <th>Euclidean Distance to Center</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($result2 as $key => $value) { ?>
                              <tr>
                                <td><?php echo $value->title; ?></td>
                                <td><?php echo $value->averagenilai; ?></td>
                                <td><?php echo $value->distance; ?></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                      </div>
                       <?php } ?>

                       <?php if(!empty($result3)) { 
                        //print_r($result1);
                        ?>
                        <div class="col-lg-12">
                          <div class="card card-primary card-outline">
                      <div class="card-body">
                        <h3>Cluster #3 - Topic/Title Recommendation</h3>
                        <p>
                          Total course(s) in Cluster #3: <?php echo count($cluster_course_3); ?><br/>
                          Number of eligible courses(s): <?php echo $eligible_course_3; ?><br/>
                          Total topic/title in Cluster #3: <? echo count($cluster_result_3); ?><br/>
                          
                          Total recommendation results in Cluster #3: <?php echo count($result3); ?></p>
<table class="table table-bordered table-striped table-hover" id="example5">
                          <thead>
                            <tr>
                              <th>Title</th>
                              <th>Average Mark</th>
                              <th>Euclidean Distance to Center</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($result3 as $key => $value) { ?>
                              <tr>
                                <td><?php echo $value->title; ?></td>
                                <td><?php echo $value->averagenilai; ?></td>
                                <td><?php echo $value->distance; ?></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                      </div>
                       <?php } ?>

                       <?php if(!empty($result4)) { 
                        //print_r($result1);
                        ?>
                        <div class="col-lg-12">
                          <div class="card card-primary card-outline">
                      <div class="card-body">
                        <h3>Cluster #4 - Topic/Title Recommendation</h3>
                        <p>
                          Total course(s) in Cluster #4: <?php echo count($cluster_course_4); ?><br/>
                          Number of eligible courses(s): <?php echo $eligible_course_4; ?><br/>
                          Total topic/title in Cluster #4: <? echo count($cluster_result_4); ?><br/>
                          
                          Total recommendation results in Cluster #4: <?php echo count($result4); ?></p>
<table class="table table-bordered table-striped table-hover" id="example6">
                          <thead>
                            <tr>
                              <th>Title</th>
                              <th>Average Mark</th>
                              <th>Euclidean Distance to Center</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($result4 as $key => $value) { ?>
                              <tr>
                                <td><?php echo $value->title; ?></td>
                                <td><?php echo $value->averagenilai; ?></td>
                                <td><?php echo $value->distance; ?></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                      </div>
                       <?php } ?>

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