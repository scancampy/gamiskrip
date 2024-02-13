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
                <div class="col-md-12">
                  <div class="d-flex mb-3">
                    <div class="">
                      <img style="width:100px" class="img-circle" src="<?php echo base_url('images/avatars/avatar1.png'); ?>"/>
                    </div>
                    <div class="d-flex flex-column justify-content-center ml-3">
                      <h5><?php echo $student[0]->first_name.' '.$student[0]->last_name.' (1220 Points)'; ?></h5>
                      <div>
                        <img style="width:30px" class="" src="<?php echo base_url('images/badges/insignia.png'); ?>"/>
                        <img style="width:30px" class="" src="<?php echo base_url('images/badges/trophy.png'); ?>"/>
                        <img style="width:30px" class="" src="<?php echo base_url('images/badges/reward.png'); ?>"/>
                      </div>
                    </div>
                    <div class="d-flex flex-fill">
<a href="<?php echo base_url('timeline'); ?>" style="align-self:flex-end;" class="btn btn-sm btn-block mr-1 <?php if($this->uri->segment(1) == 'timeline') { ?> btn-success<?php } else { ?>btn-outline-primary<?php } ?>">My Timeline</a>
                      <button style="align-self:flex-end;" class="btn btn-sm btn-block mr-1 btn-outline-primary">Discussion Board</button>
                     
                      <button style="align-self:flex-end;"  class="btn btn-sm btn-block mr-1 btn-outline-primary">Leaderboard</button>

                      <button style="align-self:flex-end;"  class="btn btn-sm btn-block mr-1 btn-outline-primary">Guild & Quest</button>
                      <button style="align-self:flex-end;"  class="btn btn-sm btn-block mr-1 btn-outline-primary">My Thesis</button>
                      <a href="<?php echo base_url('myprofile'); ?>" style="align-self:flex-end;"  class="btn btn-sm btn-block mr-1 <?php if($this->uri->segment(1) == 'myprofile') { ?> btn-success<?php } else { ?>btn-outline-primary<?php } ?>">My Profile</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h5>Thesis Progress</h5>
                    </div>

                    <div class="card-body">
                      <h3 class="text-center"><?php echo $thesis[0]->title; ?></h3>
                      <br/>
                      <div class="circlecontainerflex">
                        <div class="circlecontainer">
                          <span class="circle">1</span><br/>
                          <strong>Literature Study</strong>
                        </div>

                        <div class="circlecontainer">
                          <span class="circle">2</span><br/>
                          <strong>Data Gathering &amp; Analysis</strong>
                        </div>

                        <div class="circlecontainer">
                          <span class="circle">3</span><br/>
                          <strong>System Design</strong>
                        </div>

                        <div class="circlecontainer">
                          <span class="circle">4</span><br/>
                          <strong>Implementation</strong>
                        </div>

                        <div class="circlecontainer">
                          <span class="circle">5</span><br/>
                          <strong>Evaluation</strong>
                        </div>
                      </div>
                      <div class="line"></div> 
                      <div class="d-flex justify-content-between">
                        <span>
                        <?php echo strftime("%d-%m-%Y", strtotime($thesis[0]->start_date_in_sk)); ?>
                        </span>
                        <span>
                        <?php echo strftime("%d-%m-%Y", strtotime("+6 months", strtotime($thesis[0]->start_date_in_sk))); ?>
                       </span>
                      </div>
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                      </div>

                      <div>
                        <p>You have <?php $number_days = (strtotime("+6 months", strtotime($thesis[0]->start_date_in_sk)) - strtotime(date('Y-m-d'))) / (60 * 60 * 24); echo floor($number_days); ?> days to finish your thesis.</p>
                      </div>
                    </div>
                  </div>

                  <div class="card card-success">
                    <div class="card-header">
                      <h5>Your Quest</h5>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered table-striped">
                          <tr>
                            <th>Activity</th>
                            <th>Supervisor Check</th>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check">
                                <input type="checkbox" checked class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Build literatur review table</label>
                              </div>
                              
                            </td>
                            <td>Checked on <?php echo strftime("%d-%m-%Y", strtotime(date('Y-m-d'))); ?></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Discuss and consult with your supervisor</label>
                              </div>
                              
                            </td>
                            <td>-</td>
                          </tr>
                          <tr>
                            <td><div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Finish literature review documents</label>
                              </div>
                            </td>
                            <td>-</td>
                          </tr>
                          <tr>
                            <td><div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Establish mendeley and organize literatures</label>
                              </div>
                            </td>
                            <td>-</td>
                          </tr>
                          <tr>
                            <td><div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Share your thoughts about your topic in discussion board</label>
                              </div>
                            </td>
                            <td>-</td>
                          </tr>
                        <tfoot>
                          <tr>
                            <td colspan="2">Finish above quests before <strong><?php  echo strftime("%d-%m-%Y", strtotime("+2 weeks"));  ?></strong> to earn <span class="badge badge-warning">100 points</span></td>
                          </tr>
                        </tfoot>
                      </table>
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