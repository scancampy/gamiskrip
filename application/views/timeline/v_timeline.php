<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Timeline</h1>
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
                <div class="col-md-12 d-flex justify-content-end mb-2">
                  <select class="form-control col-md-2" id="filter_timeline">
                    <option value="all">Semua</option>
                    <option value="me">Timeline saya</option>
                  </select>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12">


                     <div class="card">
                      <div class="card-body">
                        <form method="post" action="<?php echo base_url('timeline'); ?>">
                          <div class="post">
                            <div class="user-block d-flex mb-0">
                              <?php if($userjson->avatar_image_url != '') { ?>
                                <div class="col-md-1">
                                  <div class="image mr-2" id="sidebarpropic" style="width:3.1em; height: 3.1em; border-radius: 50%; 
                                          background: url('<?php if($userjson->avatar_image_url) { echo $userjson->avatar_image_url; } else { echo base_url('images/assets/propic_blank.jpg');  } ?>');  
                     background-size: <?php if($userjson->avatar_image_url) { ?> 270% <?php } else { ?> 120% <?php } ?>;
                                          background-position: center 20%;
                                          background-color: gray;
                              background-repeat: no-repeat;  " >
                                    
                                  </div>
                                </div>
                            <?php }  else { ?>
                              <img class="img-circle mr-2 img-bordered-sm" src="<?php echo base_url('images/assets/propic_blank.jpg');  ?>" alt="user image">
                            <?php } ?>
                            <?php
                            // Define an array of status templates
$statusTemplates = [
    "Apa yang sedang kamu pikirkan? Bagikan cerita atau perasaanmu hari ini!",
    "Lagi ngapain nih? Yuk, update status kamu dan beri tahu teman-temanmu!",
    "Ada rencana seru hari ini? Jangan lupa bagikan di sini!",
    "Sedang merasa senang, sedih, atau bersemangat? Bagikan statusmu sekarang!",
    "Yuk, cerita! Apa yang ingin kamu bagikan hari ini?",
    "Punya momen menarik? Tulis statusmu dan biarkan teman-teman tahu!"
];

// Select a random template
$randomTemplate = $statusTemplates[array_rand($statusTemplates)];
                            ?>
                            <div class="d-flex flex-column col-md-11">
                              <input class="form-control form-control-sm" name="content" id="content" type="text" placeholder="<?php echo $randomTemplate; ?>" style="width: 100%;">
                              <small id="charleft">140 characters left</small>
                            </div>
                             
                            </div>
                            <div class="text-right">
                              <button type="button"  data-toggle="modal" data-target="#modal-emoji"  class="text-center btn btn-xs btn-default"><?php echo mb_convert_encoding("&#128512;", 'UTF-8', 'HTML-ENTITIES'); ?></button>
                              <input type="submit" value="Submit" name="btnSubmitComment" class="btn btn-primary btn-xs"/>
                            </div>
                            <!-- /.user-block -->                                
                          </div>
                        </form>                        
                      </div>
                    </div>
                    <div id="chat_container">
                    <?php 
                    foreach ($timeline as $key => $value) { ?>
<div class="card">
  <div class="card-body">
    <div class="post">
  <div class="user-block d-flex mb-0">
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

    <div class="d-flex flex-column col-md-11 ">
      <div class="d-flex flex-row  align-items-center justify-content-between">
        <span class="username ml-3" >
          <a href="<?php echo base_url('myprofile/'.$value->nrp); ?>"><?php echo $value->fullname; ?></a>
          <span class="description" style="margin-left:0px !important;">Member of <a href="<?php echo base_url('myclan/viewclan/'.$value->clanid.'/'.url_title($value->namaclan, '-', TRUE)); ?>"><?php echo $value->namaclan; ?></a></span>
        </span>          
        <span class="description"><?php echo formatChatTimestamp($value->created); ?></span>
        
      </div>
      <div class="ml-3"><?php echo $value->content;  ?></div>
    </div>
    
  </div>

</div>
  </div>
</div>                  
                    <?php } ?>
                  </div>
                    <?php
                    if(count($timeline) > 0) {
                      echo '<div class="text-center"><span id="loadmore" class="btn btn-sm text-center btn-outline-light">Load More</span></div>';
                      echo '<input type="hidden" name="lasttimestamp" id="lasttimestamp" value="'.$timeline[count($timeline)-1]->created.'" />';
                    } ?>                    
                </div>

              </div>
              <!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->


<div class="modal fade" id="modal-emoji">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h4 class="modal-title">Insert Emoji</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-12">
          <div class="d-flex flex-wrap">       
            <?php for($i=12; $i<=91; $i++) { ?>
              <span class="btn btn-sm btn-default btn-insert-emoji" code="<?php echo "&#1285".$i.";"; ?>"><?php echo mb_convert_encoding("&#1285".$i.";", 'UTF-8', 'HTML-ENTITIES'); ?></span>
            <?php } ?>

            <?php for($i=129296; $i<=129488; $i++) { ?>
              <span class="btn btn-sm btn-default btn-insert-emoji" code="<?php echo "&#".$i.";"; ?>"><?php echo mb_convert_encoding("&#".$i.";", 'UTF-8', 'HTML-ENTITIES'); ?></span>
            <?php } ?>

          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- The Modal -->
<div class="modal fade" id="onboarding-dialog" tabindex="-1" role="dialog" aria-labelledby="onboarding-dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Gamiskrip Timeline</h5>
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
            <p class="mb-0 onboarding-content" id="onboarding-content-1" >Halaman timeline ini adalah tempat kamu nulis statusmu. Kamu bebas mau nulis apapun.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-2" style="display:none;"  >Timelinemu bersifat public artinya statusmu bisa dibaca oleh teman-teman lain.<br/>Have fun!</p>
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