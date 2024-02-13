  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tugas Akhir</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tugas Akhir</li>
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
          <div class="col-lg-12">
            <div class="text-right">
              <a href="" class="btn btn-primary"  data-toggle="modal" data-target="#modal-default">Tambah Tugas Akhir</a>
            </div>
          </div>
        </div>
        <div class="row mt-3" >
          <div class="col-lg-12">

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Judul Tugas Akhir</th>
                      <th>Dosbing 1</th>
                      <th>Dosbing 2</th>
                      <th>Tanggal ST</th>
                      <th>Masa Berlaku</th>
                      <th>Download</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->

            
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="post" action="<?php echo base_url('tugasakhir'); ?>">
        <div class="modal-header">
          <h4 class="modal-title">Daftar Tugas Akhir Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="judul">Judul Tugas Akhir</label>
            <input type="text" class="form-control" required name="judul" id="judul" >
          </div>
          <div class="form-group">
            <label for="lecturer1_id">Dosen Pembimbing 1</label>
            <select class="form-control" required name="lecturer1_id" id="lecturer1_id" >
              <option value="-">-</option>
              <?php foreach ($lecturers as $key => $value): ?>
                <option value="<?php echo $value->user_id; ?>"><?php echo $value->fullname; ?></option>                
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="lecturer2_id">Dosen Pembimbing 2</label>
            <select class="form-control" required name="lecturer2_id" id="lecturer2_id" >
              <option value="-">-</option>
              <?php foreach ($lecturers as $key => $value): ?>
                <option value="<?php echo $value->user_id; ?>"><?php echo $value->fullname; ?></option>                
              <?php endforeach ?>
            </select>
          </div>

           <div class="form-group">
              <label for="tanggal_st">Tanggal ST</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="text" required id="datemask" name="tanggal_st" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
              </div>
            </div>

           <div class="form-group">
              <label for="tanggal_akhir_st">Tanggal Akhir ST</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="text" required id="datemask2" name="tanggal_akhir_st" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
              </div>
            </div>

            <div class="form-group">
              <label for="proposal_url">Link Google Docs Proposal Tugas Akhir</label>
              <input type="url" required class="form-control" name="proposal_url" id="proposal_url" >
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" name="btnsubmit" value="submit">Simpan</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->