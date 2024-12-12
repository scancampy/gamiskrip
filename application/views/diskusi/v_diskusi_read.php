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
                  <div class="col-lg-1 col-3">
                    <div class="text-center" id="propic" style="width:60px; height: 60px; border-radius: 50%; margin-left: auto; margin-right: auto;
                background: url('<?php if($thread->avatar_image_url) { echo $thread->avatar_image_url; } else { echo base_url('images/assets/propic_blank.jpg');  } ?>');  
                background-size: <?php if($thread->avatar_image_url) { ?> 270% <?php } else { ?> 120% <?php } ?>;
                background-position: center 20%;
                background-color: gray;
    background-repeat: no-repeat;  " >
                </div>
                  </div>
                  <div class="col-lg-11 col-9">
                    <h5><?php echo $thread->thread_title; ?></h5>
                    <h6><a href="<?php echo base_url('myprofile/viewprofile/'.$thread->nrp); ?>"><?php echo '@'.$thread->first_name.' '.$thread->last_name; ?></a>
                      <small>Member of <a href="<?php echo base_url('myclan/viewclan/'.$thread->clanid.'/'.url_title($thread->namaclan, '-', TRUE)); ?>"><?php echo $thread->namaclan; ?></a></small>
                      <span class="mailbox-read-time float-right"><?php echo strftime("%d %B %Y @ %H:%S", strtotime($thread->created)); ?></span></h6>
                      <span class="badge badge-success"><?php echo ucwords(str_replace("_", " ", str_replace("add_post_", "", $thread->thread_type))); ?></span>
                  </div>
                </div>
              </div>              
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="container mt-2">
                <div class="row">
                  <div class="col-12">
                    <article><?php echo $thread->content;  ?></article>

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
               <a  threadid="<?php echo $thread->id; ?>" class="btn btnlikes text-right btn-sm btn-default"><i class="fas fa-thumbs-up"></i> <span id="numlikes_<?php echo $thread->id; ?>"><?php echo $thread->num_likes;  ?></span> likes</a>
            </div>

            <?php foreach ($thread_reply as $key => $value) { ?>
             <hr/>
            <div class="container mt-2">
              <div class="row">
                <div class="col-lg-1 col-3">
                  <div class="text-center" id="propic" style="width:60px; height: 60px; border-radius: 50%; margin-left: auto; margin-right: auto;
                    background: url('<?php if($value->avatar_image_url) { echo $value->avatar_image_url; } else { echo base_url('images/assets/propic_blank.jpg');  } ?>');  
                     background-size: <?php if($value->avatar_image_url) { ?> 270% <?php } else { ?> 120% <?php } ?>;
                background-position: center top;
        background-repeat: no-repeat;  " >
                    </div>
                </div>
                <div class="col-lg-11 col-9">
                  <span><a href="<?php echo base_url('myprofile/viewprofile/'.$value->nrp); ?>"><?php echo '@'.$value->first_name.' '.$value->last_name; ?></a></span> <small>Member of <a href="<?php echo base_url('myclan/viewclan/'.$value->clanid.'/'.url_title($value->namaclan, '-', TRUE)); ?>"><?php echo $value->namaclan; ?></a></small>
                  <span class="mailbox-read-time float-right"><?php echo strftime("%d %B %Y @ %H:%S", strtotime($value->created)); ?></span>
                  <article>
                    <?php echo mb_convert_encoding(parse_bbcode(nl2br($value->content)), 'UTF-8', 'HTML-ENTITIES'); ?>
                  </article>
                  <div class="text-right">
                     <a  threadid="<?php echo $value->id; ?>" class="btn btnlikesreply text-right btn-sm btn-default"><i class="fas fa-thumbs-up"></i> <span id="numlikesreply_<?php echo $value->id; ?>"><?php echo $value->num_likes;  ?></span> likes</a>
                    
                  </div>
                </div>
                 
              </div>
            </div>
            <?php } ?>

            <hr/>
              <div class="text-center card-footer clearfix d-flex justify-content-center align-items-center" >
                <?php echo $paging; ?>
              </div>
            </div>
           
          </div>

                    </div>

<div class="col-12">
  <form method="post" accept-charset="UTF-8" action="<?php echo base_url('diskusi/read/'.$thread->id.'/'.url_title($thread->thread_title)); ?>">
    <div class="card card-primary card-outline">
      <div class="card-header"><h6>Balas Diskusi</h6></div>
      <div class="card-body p-0">
        <div class="container mt-4">
          <div class="row">
            <div class="col-lg-2 col-3">
              <div class="text-center" id="propic" style="width:100px; height: 100px; border-radius: 50%; margin-left: auto; margin-right: auto;
                background: url('<?php if($userjson->avatar_image_url) { echo $userjson->avatar_image_url; } else { echo base_url('images/assets/propic_blank.jpg');  } ?>');  
                background-size: <?php if($userjson->avatar_image_url) { ?> 270% <?php } else { ?> 120% <?php } ?>;
                background-position: center 20%;
                background-color: gray;
    background-repeat: no-repeat;  " >
                </div>
            </div>
            <div class="col-lg-10 col-9">
              <textarea class="form-control" name="content" id="content" placeholder="Tulis pesan anda..." rows="6"></textarea>
            </div>

            <div class="col-lg-2 col-3">
            </div>
            <div class="col-lg-10 col-9 text-right mt-2 mb-4 d-flex justify-content-between">
              <div>
                <button type="button"  data-toggle="modal" data-target="#modal-help"  class="text-center btn btn-xs btn-flat btn-info">Formatting Help</button>
                <button type="button"  data-toggle="modal" data-target="#modal-emoji"  class="text-center btn btn-xs btn-default"><?php echo mb_convert_encoding("&#128512;", 'UTF-8', 'HTML-ENTITIES'); ?></button>
              </div>
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

<div class="modal fade" id="modal-help">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h4 class="modal-title">Formatting Help</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Sintaks</th>
              <th>Contoh</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>[h1]Header Text[/h1]</td>
              <td><h1>Header Text</h1></td>
            </tr>
            <tr>
              <td>[h2]Header Text[/h2]</td>
              <td><h2>Header Text</h2></td>
            </tr>
            <tr>
              <td>[h3]Header Text[/h3]</td>
              <td><h3>Header Text</h3></td>
            </tr>
            <tr>
              <td>[b]Bold Text[/b]</td>
              <td><strong>Bold Text</strong></td>
            </tr>
            <tr>
              <td>[u]Underlined Text[/u]</td>
              <td><u>Underlined Text</u></td>
            </tr>            
            <tr>
              <td>[i]Italic Text[/i]</td>
              <td><em>Italic Text</em></td>
            </tr>
            <tr>
              <td>[strike]Strikethrough text [/strike]</td>
              <td><s>Strikethrough text </s></td>
            </tr>
            <tr>
              <td>[code] Fixed-width font, preserves spaces [/code]</td>
              <td><pre><code>Fixed-width font, preserves spaces </code></pre></td>
            </tr>
            <tr>
              <td>[url=gamiskrip.jitusolution.com] Website link [/url]</td>
              <td><a href="gamiskrip.jitusolution.com">gamiskrip.jitusolution.com</a></td>
            </tr>
          </tbody>
        </table>
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