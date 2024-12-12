<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">My Clan</h1>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('myclan'); ?>">My Clan</a></li>
              
            </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
          <!-- Main content -->
          <div class="content">
            <div class="row">
              <div class="container mt-1">
                 <!-- Date Period -->
    <div class="row mb-4">
        <div class="col-12 text-center">
          <img src="<?php echo base_url('images/assets/clan_'.$clan->id.'.jpg'); ?>" style="max-width: 100px;" />
            <h3><?php echo $clan->nama; ?></h3>
        </div>
    </div>
              <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card ">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3"></h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link  active" href="#tab_1" data-toggle="tab">Info Clan</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Chat</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Aktivitas</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active " id="tab_1">
                    <div class="d-flex">
                      <div class="col-md-3">
                        <img src="<?php echo base_url('images/assets/clan_'.$clan->id.'_pic.jpg'); ?>" class="img-fluid"/>
                      </div>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-xs-12 col-md-12">Kamu tergabung dalam clan <?php echo $clan->nama; ?>. 
                            <?php echo $clan->description; ?>
                            <br/><strong>Jumlah anggota: <?php echo count($clan_members); ?></strong>
                          </div>
                        </div>  
                        <div class="row">
                          <div class="col mt-2">
                            <table class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>NRP</th>
                                  <th>Nama</th>
                                  <th>Points</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($clan_members as $key => $value) { ?>
                                  <tr>
                                    <td><a href="<?php echo base_url('myprofile/viewprofile/'.$value->nrp); ?>"><?php echo $value->nrp; ?></a></td>
                                    <td><a href="<?php echo base_url('myprofile/viewprofile/'.$value->nrp); ?>"><?php echo $value->fullname; ?></a></td>
                                    <td><?php if($value->total_points == NULL) { echo "0"; } else { echo $value->total_points; } ?></td>
                                  </tr>
                                <?php } ?>
                                
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    
                    <?php
                    if(count($chat) == 0) {
                        echo '<p class="text-center"><small>Jadilah orang pertama yang memulai chat!</small></p>';
                    } else {
                      echo '<div class="text-center"><a href="#" id="loadmore" class="btn btn-sm text-center btn-outline-light">Load More</a></div>';

                      $arrayreverse = array_reverse($chat);

                      echo '<input type="hidden" name="lasttimestamp" id="lasttimestamp" value="'.$arrayreverse[0]->timestamp.'" />';
                    } ?>
                    <div id="chat_container">
                      <?php
                     foreach (array_reverse($chat) as $key => $value) { ?>
                      <div class="post" style="padding-bottom: 0px;">
                        <div class="user-block d-flex justify-content-start mb-0" >
                          <?php if($value->avatar_image_url!="") { ?>
                            <div class="img-circle img-bordered-sm" id="sidebarpropic" style="width:2.1em; height: 2.1em; border-radius: 50%; margin-left: auto; margin-right: auto;
                          background: url('<?php echo $value->avatar_image_url; ?>?background=255,255,255');  background-size: 270%;
                          background-position: center 20%;
                          background-color: gray; margin-left:0px; margin-right:0px;
              background-repeat: no-repeat;   " >
                    
                  </div>
                          
                        <?php } else { ?>
                          <img class="img-circle img-bordered-sm" src="<?php echo base_url('images/assets/propic_blank.jpg');  ?>" alt="user image">
                        <?php } ?>
                         <div class="d-flex flex-column">
                            <span class="username" style="margin-left:15px !important;">
                              <a href="<?php echo base_url('myprofile/'.$value->nrp); ?>"><?php echo $value->fullname; ?></a>
                            </span>
                            <span class="description" style="margin-left:15px !important;"><?php echo formatChatTimestamp($value->timestamp); ?></span>
                          </div>
                        </div>
                        <!-- /.user-block -->
                        <p>
                          <?php echo $value->message; ?><br/>
                          <a href="#" class="link-black text-sm likebutton" chatid="<?php echo $value->id; ?>"><i class="far fa-thumbs-up mr-1"></i> <?php if($value->like_count>0) { echo $value->like_count.' Likes'; } else { echo 'Like'; } ?></a>
                        </p>
                                               
                      </div>
                    <?php } ?>
                  </div>
                    <form method="post" action="<?php echo base_url('myclan#tab2'); ?>">
                        <input class="form-control form-control-sm" type="text" name="comment" placeholder="Type a comment" onkeydown="submitOnEnter(event)">
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                    <table class="table table-striped table-bordered" id="quest_table">
                        <thead class="table-dark" >
                            <tr>
                                <th ><i class="fas fa-user"></i> Name</th>
                                <th ><i class="fas fa-bullseye"></i> Quest</th>
                                <th ><i class="fas fa-calendar-check"></i> Completed Date</th>
                                <th ><i class="fas fa-trophy"></i> Points</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($quest as $key => $value) { ?>
                            <tr>
                              <td><a href="<?php echo base_url('myprofile/viewprofile/'.$value->nrp); ?>"><?php echo $value->first_name.' '.$value->last_name; ?></a></td>
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
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
        </div>
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
        <h5 class="modal-title" id="myModalLabel">Gamiskrip Clan</h5>
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
            <p class="mb-0 onboarding-content" id="onboarding-content-1" >Selamat datang di clanmu. Secara otomatis kamu akan di gabungkan ke dalam clan bersama-sama temanmu yang lain.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-2" style="display:none;"  >Di halaman clan ini kamu bisa mengetahui poin masing-masing anggota. Akumulasi poin anggota ini digunakan untuk membuat rangking clan pada menu <strong>Leaderboard</strong></p>
            <p class="mb-0 onboarding-content" id="onboarding-content-3" style="display:none;" >Tekan tab "Chat" untuk ngobrol bareng teman-teman clanmu. </p>
            <p class="mb-0 onboarding-content" id="onboarding-content-4" style="display:none;"  >Tekan tab "Aktivitas" untuk lihat quest-quest yang sudah diselesaikan temanmu.<br/>Have fun!</p>
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