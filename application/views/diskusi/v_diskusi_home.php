<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Ruang Diskusi</h1>
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
            <div class="row">
              <div class="col-12 text-right mb-2">
               <?php if($admin) { ?>
                <a data-toggle="modal" id="btn_create_folder" data-target="#modal-lg" class="btn btn-primary"><i class="fas fa-folder-plus"></i> Buat Folder</a> <?php } ?>
                <a href="<?php echo base_url('diskusi/baru/'.$parent_folder_id); ?>" class="btn btn-primary"><i class="fas fa-comments"></i> Buat Diskusi</a>
              </div>
            </div>
            <div class="card">
        <div class="card-body p-0">
          <div class="container">
            <div class="col-12 mt-4 mb-4">

          <?php //print_r($diskusi_folder); ?>
          <table class="table table-striped projects" id="commontable">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          
                      </th>
                      <th >
                          Judul
                      </th>
                      <th style="width: 15%">
                          Tanggal
                      </th>
                      <th style="width: 10%">
                          Num. of Reply
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php foreach ($diskusi_folder as $key => $value) { ?>
                  <tr>
                      <td>
                          <i class="fas fa-folder"></i> 
                      </td>
                      <td><a href="<?php echo base_url('diskusi/home/'.$value->id.'/'.url_title($value->folder_title)); ?>"><?php echo $value->folder_title; ?><br>
                          <small>
                              <?php echo '@'.$value->first_name.' '.$value->last_name; ?>
                          </small></td>
                          <td><?php echo strftime("%d %b, %Y", strtotime($value->created)); ?></a></td>
                      <td>0</td>
                    </tr>
                <?php } ?>

                <?php foreach ($threads as $key => $value) { ?>
                  <tr>
                    <td><?php if($reads[$key]) { echo '<i class
                    ="fas fa-envelope-open"></i>'; } else { echo '<i class
                    ="fas fa-envelope"></i>'; } ?></td>
                    <td><a href="<?php echo base_url('diskusi/read/'.$value->id.'/'.url_title($value->thread_title)); ?>">
                      <?php echo $value->thread_title; ?> <span class="badge badge-success"><?php //echo $value->thread_type;  
                      echo ucwords(str_replace("_", " ", str_replace("add_post_share_", "", $value->thread_type))); ?></span><br/>
                      <small>
                              <?php echo '@'.$value->first_name.' '.$value->last_name; ?>
                          </small>
                        </a>
                    </td>
                    <td><?php echo strftime("%d %b, %Y", strtotime($value->created)); ?></td>
                    <td><?php echo $num_of_reply[$key]; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
          </table>
        </div>
      </div>
        </div>
        <!-- /.card-body -->
      </div>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" action="<?php echo base_url('diskusi/home/'.$parent_folder_id); ?>">
        <div class="modal-header">
          <h4 class="modal-title">Buat Folder</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="folder_title">Judul Folder</label>
            <input type="text" class="form-control" id="folder_title" name="folder_title" placeholder="Tuliskan Judul Folder" required>
          </div>

          <div class="form-group">
            <label for="notes">Keterangan</label>
            <textarea class="form-control" rows="3" name="notes" id="notes" placeholder="Tuliskan Keterangan"></textarea>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" name="btnsubmit" value="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- The Modal -->
<div class="modal fade" id="onboarding-dialog" tabindex="-1" role="dialog" aria-labelledby="onboarding-dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Gamiskrip Ruang Diskusi</h5>
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
            <p class="mb-0 onboarding-content" id="onboarding-content-1" >Ruang diskusi adalah tempat kamu untuk berdiskusi, sharing, meminta bantuan, atau sekedar say hi ke teman-teman.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-2" style="display:none;"  >Untuk memulai diskusi, tekan tombol <strong>Buat Diskusi</strong> di ujung kanan atas.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-3" style="display:none;" >Untuk membaca suatu diskusi, tekan salah satu judul diskusi yang ada. Kamu bahkan bisa ikutan membalas suatu diskusi yang seru.<br/>Have fun! </p>
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