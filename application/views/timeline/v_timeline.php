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
                        </ul>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                  <div class="col-md-9 ">
                    <div class="d-flex flex-fill mb-3">

                      <button style="align-self:flex-end;" class="btn btn-sm btn-block mr-1 btn-success">My Timeline</button>
                      <button style="align-self:flex-end;" class="btn btn-sm btn-block mr-1 btn-outline-primary">Discussion Board</button>
                     
                      <button style="align-self:flex-end;"  class="btn btn-sm btn-block mr-1 btn-outline-primary">Leaderboard</button>

                      <button style="align-self:flex-end;"  class="btn btn-sm btn-block mr-1 btn-outline-primary">Guild & Quest</button>
                      <button style="align-self:flex-end;"  class="btn btn-sm btn-block mr-1 btn-outline-primary">My Thesis</button>
                      <button style="align-self:flex-end;"  class="btn btn-sm btn-block mr-1 btn-outline-primary">My Profile</button>
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
                        <img class="img-circle img-bordered-sm" src="<?php echo base_url('dist/img/user7-128x128.jpg'); ?>" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
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