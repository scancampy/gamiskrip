<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Buat Diskusi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('diskusi/home'); ?>">Ruang Diskusi</a></li>
              <li class="breadcrumb-item"><a href="#">Buat Diskusi</a></li>
            </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
          <!-- Main content -->
          <div class="content">
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('diskusi/new/'.$parent_folder_id); ?>">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Buat Diskusi</h3>
              </div>
              <div class="card-body p-0">
                <div class="container">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group mt-4">
                        <label for="thread_title">Judul</label>
                        <input type="text" class="form-control" id="thread_title" name="thread_title" placeholder="Masukkan judul diskusi">
                      </div>

                      <div class="form-group">
                        <label for="content">Isi</label>
                        <textarea rows="10" id="summernote" name="content">
                          Tuliskan isi diskusi
                        </textarea>
                      </div>

                      <?php if($admin) { ?>
                      <div class="form-check mb-4">
                        <input type="checkbox" value="1" class="form-check-input" id="is_locked" name="is_locked">
                        <label class="form-check-label" for="is_locked">Kunci Diskusi Ini</label>
                      </div>
                    <?php } ?>

                    </div>
                    <div class="col-12">
                      <table class="table table-striped" id="commontable">
                        <thead>
                            <tr>
                              <td>File</td>
                              <td width="10%">Hapus</td>
                            </tr>
                        </thead>
                        <tbody id="tbody_files">
                          <tr>
                            <td colspan="2">Belum ada file</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-12 text-right mb-4">
                      <a class="btn btn-secondary" id="btnaddfiles"><i class="fas fa-plus"></i> Tambah File</a>
                      <input type="hidden" name="hidjumlah" id="hidjumlah" />
                    </div>
                  </div>
                </div>
                
              </div>
        <!-- /.card-body -->
              <div class="card-footer">
                <div class="container">
                  <div class="row">
                    <div class="col-12">
                      <input type="submit" class="btn btn-primary" value="Submit" name="btnsubmit" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->