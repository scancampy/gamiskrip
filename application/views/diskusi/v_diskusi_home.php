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
                <a href="<?php echo base_url('diskusi/new/'.$parent_folder_id); ?>" class="btn btn-primary"><i class="fas fa-comments"></i> Buat Diskusi</a>
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
                          Post
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
                      <?php echo $value->thread_title; ?><br/>
                      <small>
                              <?php echo '@'.$value->first_name.' '.$value->last_name; ?>
                          </small>
                        </a>
                    </td>
                    <td><?php echo strftime("%d %b, %Y", strtotime($value->created)); ?></td>
                    <td>0</td>
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