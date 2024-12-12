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
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('diskusi/baru/'.$parent_folder_id); ?>">
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

                      <div class="form-group mt-4">
                        <label for="thread_type">Jenis</label>
                        <select class="form-control" id="thread_type" name="thread_type">
                          <option value="general_discussion">General Discussion</option>
                          <option value="add_post_ask_for_help">Ask for help</option>
                          <option value="add_post_share_knowledge">Share Knowledge</option>
                          <option value="add_post_share_work_in_progress">Share Work In Progress</option>
                        </select>
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


<!-- The Modal -->
<div class="modal fade" id="onboarding-dialog" tabindex="-1" role="dialog" aria-labelledby="onboarding-dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Gamiskrip Ruang Diskusi - Buat Diskusi Baru</h5>
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
            <p class="mb-0 onboarding-content" id="onboarding-content-1" >Buat Diskusi yang seru. Pertama-tama tentukan judulnya dulu.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-2" style="display:none;"  >Lalu pilih jenis diskusinya. Terdapat tiga jenis diskusi yang dapat dibuat: 1) General Discussion; 2) Ask for Help; 3) Share Knowledge; dan 4) Share Work in Progress;</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-3" style="display:none;" ><strong>General Discussion</strong> untuk bikin diskusi bebas. <strong>Ask for Help</strong> bisa kamu pakai untuk minta bantuan terkait skripsimu.</p>
            <p class="mb-0 onboarding-content" id="onboarding-content-4" style="display:none;" ><strong>Share Knowledge</strong> buat kamu yang pingin share info penting dan bermanfaat. <strong>Share work in Progress</strong> bisa kamu gunakan untuk share progress skripsimu kepada teman-teman.</p>            
            <p class="mb-0 onboarding-content" id="onboarding-content-5" style="display:none;" >Selain itu, kamu juga boleh tautkan file yang berhubungan dengan diskusimu ini. <br/>Have fun!</p>
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

