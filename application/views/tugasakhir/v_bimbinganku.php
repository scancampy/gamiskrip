  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Bimbinganku</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Bimbinganku</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row mt-3" >
          <div class="col-lg-12">

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" id="commontable">
                  <thead>
                    <tr>
                      <th>NRP</th>
                      <th>Nama</th>
                      <th>Judul</th>
                      <th>Dosbing</th>
                      <th>Masa Berlaku ST</th>
                      <th style="width: 40px">Status</th>
                      <th style="width: 120px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($tugasakhir) { 
                      foreach ($tugasakhir as $key => $value) { //print_r($value); ?>
                    <tr>
                      <td><?php echo $value->nrp; ?></td>
                      <td><?php echo $value->fullname; ?></td>                      
                      <td><?php echo $value->judul; ?></td>
                      <td><?php echo $value->f1.' &amp; '.$value->f2; ?></td>
                      <td><?php echo strftime("%d %B %Y", strtotime($value->tanggal_akhir_st)); ?></td>
                      <td style="width: 40px"><?php if($value->is_active == 0) { echo '<span class="badge badge-secondary">Menunggu Approval Dosbing</span>'; } else if($value->is_active ==1 && strtotime($value->tanggal_akhir_st) > strtotime(date('Y-m-d')) ) { echo '<span class="badge badge-primary">Aktif</span>'; } else {
                        echo '<span class="badge badge-danger">ST berakhir</span>';
                      } ?></td>
                      <td><a href="" data-toggle="modal" data-target="#modal-default" class="btn btn-xs btn-primary mr-1 btndetilbimbingan" targetid="<?php echo $value->id; ?>">Detail</a><a href="<?php echo base_url('tugasakhir/logbimbinganku/'.$value->id); ?>" class="btn btn-xs btn-warning">Log Bimbingan</a></td>
                    </tr>    
                     <?php }
                      } ?>
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
          <h4 class="modal-title">Data Skripsi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <dl>
            <dt>Judul</dt>
            <dd id="dd-judul"></dd>
          </dl>

          <dl>
            <dt>Mahasiswa</dt>
            <dd id="dd-mhs"></dd>
          </dl>

          <dl>
            <dt>Dosbing 1</dt>
            <dd id="dd-dosbing1"></dd>
          </dl>

          <dl>
            <dt>Dosbing 2</dt>
            <dd id="dd-dosbing2"></dd>
          </dl>

          <dl>
            <dt>Proposal</dt>
            <dd id="dd-proposal"></dd>
          </dl>

          <dl>
            <dt>Tanggal ST</dt>
            <dd id="dd-tanggal-st"></dd>
          </dl>

          <dl>
            <dt>Masa Berlaku ST</dt>
            <dd id="dd-masa-berlaku-st"></dd>
          </dl>

          <dl>
            <dt>Status</dt>
            <dd id="dd-status"></dd>
          </dl>
            
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>

          <button type="submit" class="btn btn-primary" name="btnvalidasi" id="btnvalidasi" value="submit">Validasi Skripsi</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->