<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">My Timeline</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard/student'); ?>">Dashboard</a></li>
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
                  <div class="col-md-3">
                    <div class="card card-primary card-outline">
                      <div class="card-body box-profile">
                        <div class="text-center">
                          <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('images/avatars/avatar1.png'); ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?php echo $student[0]->first_name.' '.$student[0]->last_name; ?></h3>


                        <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item">
                            <b>Guild</b> <a class="float-right">Clustering (5 members)</a>
                          </li>
                          <li class="list-group-item">
                            <b>Points</b> <a class="float-right">2230</a>
                          </li>
                          <li class="list-group-item">
                            <b>Progress</b> <a class="float-right">Literature Study</a>
                          </li>

                          <li class="list-group-item">
                            <b>Badges</b> <a class="float-right">5 Badges earned</a>
                          </li>
                        </ul>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                  <div class="col-md-9 ">
                    <div class="d-flex flex-fill mb-3">

                      <a href="<?php echo base_url('timeline'); ?>" style="align-self:flex-end;" class="btn btn-sm btn-block mr-1 <?php if($this->uri->segment(1) == 'timeline') { ?> btn-success<?php } else { ?>btn-outline-primary<?php } ?>">My Timeline</a>
                      <button style="align-self:flex-end;" class="btn btn-sm btn-block mr-1 btn-outline-primary">Discussion Board</button>
                     
                      <button style="align-self:flex-end;"  class="btn btn-sm btn-block mr-1 btn-outline-primary">Leaderboard</button>

                      <button style="align-self:flex-end;"  class="btn btn-sm btn-block mr-1 btn-outline-primary">Guild & Quest</button>
                      <button style="align-self:flex-end;"  class="btn btn-sm btn-block mr-1 btn-outline-primary">My Thesis</button>
                      <a href="<?php echo base_url('myprofile'); ?>" style="align-self:flex-end;"  class="btn btn-sm btn-block mr-1 <?php if($this->uri->segment(1) == 'myprofile') { ?> btn-success<?php } else { ?>btn-outline-primary<?php } ?>">My Profile</a>
                    </div>
                    
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
                        <hr/>

                        <table class="table table-bordered table-striped">
                          <tr>
                            <td>File</td>
                            <td>Validated Date</td>
                          </tr>
                          <tr>
                            <td><a href=""><span class="fa fa-file-pdf"></span> Proposal</a></td>
                            <td>Validated on <?php echo strftime("%d-%m-%Y", strtotime(date('Y-m-d'))); ?></td>
                          </tr>
                          <tr>
                            <td><a href=""><span class="fa fa-file-pdf"></span> Chapter 1</a></td>
                            <td>Validated on <?php echo strftime("%d-%m-%Y", strtotime(date('Y-m-d'))); ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>

                   <div class="card card-success">
                    <div class="card-header">
                      <h5>Current Quest</h5>
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

                  <div class="card">
                      <div class="card-body">
                        <div class="post">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="<?php echo base_url('images/avatars/avatar1.png'); ?>" alt="user image">
                          <span class="username">
                            <a href="#"><?php echo $student[0]->first_name.' '.$student[0]->last_name; ?></a>
                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                          </span>
                          <span class="description">Shared publicly - 7:30 PM today</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                          Lorem ipsum represents a long-held tradition for designers,
                          typographers and the like. Some people hate it and argue for
                          its demise, but others ignore the hate as they create awesome
                          tools to help create filler text for everyone from bacon lovers
                          to Charlie Sheen fans.
                        </p>

                        <p>
                          <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                          <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                          <span class="float-right">
                            <a href="#" class="link-black text-sm">
                              <i class="far fa-comments mr-1"></i> Comments (5)
                            </a>
                          </span>
                        </p>

                        <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                      </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body">
                        <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?php echo base_url('images/avatars/avatar1.png'); ?>" alt="User Image">
                        <span class="username">
                          <a href="#"><?php echo $student[0]->first_name.' '.$student[0]->last_name; ?></a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Sent you a message - 3 days ago</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>

                      <form class="form-horizontal">
                        <div class="input-group input-group-sm mb-0">
                          <input class="form-control form-control-sm" placeholder="Response">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-danger">Send</button>
                          </div>
                        </div>
                      </form>
                    </div>
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