<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?php echo $thread->thread_title; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('diskusi/home'); ?>">Ruang Diskusi</a></li>

              <?php for ($i = count($arraybreadcrumb)-1; $i >=0; $i--) { ?>
                <li class="breadcrumb-item"><a href="<?php echo base_url('diskusi/home/'.$arraybreadcrumb[$i]->id.'/'.url_title($arraybreadcrumb[$i]->folder_title)); ?>"><?php echo $arraybreadcrumb[$i]->folder_title; ?></a></li>
              <?php } ?>
              
            </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
          <!-- Main content -->
          <div class="content">
            <div class="col-12">
                      <div class="card card-primary card-outline">
            <div class="card-header">
              <div class="container">
                <div class="row">
                  <div class="col-1">
                    <div class="text-center" id="propic" style="width:60px; height: 60px; border-radius: 50%; margin-left: auto; margin-right: auto;
                background: url('<?php echo base_url('uploads/avatars/'.$thread->avatar_image_filename); ?>');  background-size: cover;
    background-repeat: no-repeat;  " >
                </div>
                  </div>
                  <div class="col-11">
                    <h5><?php echo $thread->thread_title; ?></h5>
                    <h6><?php echo '@'.$thread->first_name.' '.$thread->last_name; ?>
                      <span class="mailbox-read-time float-right"><?php echo strftime("%d %B %Y @ %H:%S", strtotime($thread->created)); ?></span></h6>
                  </div>
                </div>
              </div>              
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="container mt-2">
                <div class="row">
                  <div class="col-12">
                    <article><?php echo $thread->content; ?></article>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white">
              <?php if(count($files) >0) { ?>
              <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                <?php foreach ($files as $key => $value) { ?>
                  <li>
                   
                    <div class="mailbox-attachment-info">
                      <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> <?php echo $value->title; 
// Given filename
$filename = $value->filename;

// Get the position of the last dot in the filename
$dotPosition = strrpos($filename, '.');

// Check if dot exists in filename
if ($dotPosition !== false) {
    // Extract the file extension
    $fileExtension = substr($filename, $dotPosition + 1);
    echo '.'.$fileExtension;
} 

                    ?></a>
                          <span class="mailbox-attachment-size clearfix mt-1">
                            <span><?php echo number_format(filesize('./uploads/diskusi/'.$filename)/1024,0,',','.'); ?> KB</span>
                            <a href="<?php echo base_url('uploads/diskusi/'.$filename); ?>" target="_blank" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                          </span>
                    </div>
                  </li>
                <?php } ?>
                
                
              </ul>
            <?php } ?>
            <div class="text-right">
              <a href="#" class="btn text-right btn-sm btn-default"><i class="fas fa-quote-left"></i> Quote</a>
            </div>

            <?php foreach ($thread_reply as $key => $value) { ?>
             <hr/>
            <div class="container mt-2">
              <div class="row">
                <div class="col-1">
                  <div class="text-center" id="propic" style="width:60px; height: 60px; border-radius: 50%; margin-left: auto; margin-right: auto;
                    background: url('<?php echo base_url('uploads/avatars/'.$value->avatar_image_filename); ?>');  background-size: cover;
        background-repeat: no-repeat;  " >
                    </div>
                </div>
                <div class="col-11">
                  <span><?php echo '@'.$value->first_name.' '.$value->last_name; ?></span>
                  <span class="mailbox-read-time float-right"><?php echo strftime("%d %B %Y @ %H:%S", strtotime($value->created)); ?></span>
                  <article>
                    <?php echo $value->content; ?>
                  </article>
                </div>
              </div>
            </div>
            <?php } ?>
            </div>
           
          </div>

                    </div>

<div class="col-12">
  <form method="post" action="<?php echo base_url('diskusi/read/'.$thread->id.'/'.url_title($thread->thread_title)); ?>">
    <div class="card card-primary card-outline">
      <div class="card-header"><h6>Balas Diskusi</h6></div>
      <div class="card-body p-0">
        <div class="container mt-4">
          <div class="row">
            <div class="col-1">
                <div class="text-center" id="propic" style="width:60px; height: 60px; border-radius: 50%; margin-left: auto; margin-right: auto;
                  background: url('<?php echo base_url('uploads/avatars/'.$userjson->avatar_image_filename); ?>');  background-size: cover;
      background-repeat: no-repeat;  " >
                  </div>
              </div>
              <div class="col-11">
                <textarea class="form-control" name="content" id="summernote" rows="6"></textarea>
              </div>
            <div class="col-12 text-right mt-2 mb-4">
              <input type="submit" value="Kirim" class="btn btn-sm btn-primary" name="btnSubmit"/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->