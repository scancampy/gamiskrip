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
              <li class="breadcrumb-item active">Log Bimbingan</li>
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
            <?php echo $infobox; ?>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="text-right">
              <a href="" class="btn btn-primary"  data-toggle="modal" data-target="#modal-default">Tambah Log</a>
            </div>
          </div>
        </div>
       
            <?php if($logs) { ?>
               <div class="row mt-3" >
          <div class="col-lg-12">
            <div class="card card-primary">
              <div class="card-body">
                <!-- The timeline -->
            <div class="timeline timeline-inverse">
                    <?php  foreach ($logs as $key => $value) { ?>
<!-- timeline time label -->
              <div class="time-label">
                <span class="bg-primary">
                  <?php echo strftime("%d %B %Y", strtotime($value->tanggal)); ?> (Bimbingan #<?php echo $key+1; ?>)
                </span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-clipboard-list bg-secondary"></i>

                <div class="timeline-item">
                
                  <h3 class="timeline-header"><?php echo $value->judul; ?></h3>

                  <div class="timeline-body">
                    <?php echo $value->keterangan; ?><br/>
                    <?php 

                    $table_have_content = false;
                    if($filelogs[$key]) {  $table_have_content = true; ?>
                    <p>
                      File &amp; Tautan: 
                      <?php foreach ($filelogs[$key] as $key2 => $value2) {  ?>
                        <a href="<?php echo base_url('uploads/logbimbingan/'.$value2->nama_file); ?>" class="btn btn-outline-success btn-xs"><span class="fa fa-file"></span> <?php echo $value2->judul; ?></a>
                      <?php } ?>

                      <?php if($value->link_file != '') { $table_have_content = true; ?>
                        <a href="<?php echo $value->link_file; ?>" class="btn btn-outline-success btn-xs"><span class="fa fa-link"></span> Buka Tautan</a>
                      <?php } ?>
                    </p>
                  <?php } ?>

                  <?php foreach ($komentar[$key] as $key3 => $value3) { ?>
                      <hr/>
                    
                    <div class="post" style="padding-bottom:0px; border-bottom: none; margin-bottom: 0px;">                    
                        <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a ><?php echo $komentar_user[$key][$key3][0]->fullname; ?></a>
                        </span>
                        <span class="description"><?php echo strftime("%d %B %Y", strtotime($value3->created)); ?></span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        <?php echo $value3->komentar; ?>
                      </p>
                    </div>
                      <?php } ?>
                      
                  <form class="form-horizontal" method="post" action="<?php echo base_url('tugasakhir/logbimbingan/'); ?>">
                    <input type="hidden" name="idlogs" value="<?php echo $value->id; ?>"/>
                    <div class="input-group input-group-sm mb-0">
                      <input class="form-control form-control-sm" placeholder="Tuliskan tanggapan/komentar" name="komentar">
                      <div class="input-group-append">
                        <button type="submit" name="btnkirim" value="submit" class="btn btn-danger">Kirim</button>
                      </div>
                    </div>
                  </form>
                  </div>

                  <!-- buat comment -->
                </div>
              </div>
              <!-- END timeline item -->
            <?php } ?>

            </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      <?php } ?>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('tugasakhir/logbimbingan'); ?>">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Log Bimbingan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="judul">Judul Log</label>
            <input type="text" class="form-control" required name="judul" id="judul" >
          </div>

          <div class="form-group">
            <label for="perihal">Perihal</label>
            <select class="form-control" name="perihal" id="perihal">
              <?php foreach ($perihal as $key => $value) { ?>
                <option value="<?php echo $value->id; ?>"><?php echo $value->perihal; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control"  name="keterangan" id="keterangan" ></textarea>
          </div>

           <div class="form-group">
            <label for="keterangan">Tanggal Bimbingan</label>
             <input type="text" class="form-control" readonly value="<?php echo strftime("%d-%m-%Y", strtotime(date('Y-m-d'))); ?>"/>
          </div>
          

          <div class="form-group">
            <label for="link_file">Link File</label>
            <input type="text"  class="form-control" name="link_file" id="link_file" >
          </div>
          <input type="hidden" name="jumlahupload" id="jumlahupload" value="1" />
          <div id="filecontainer">
            <div class="form-group">
              <label for="file1">Upload File #1</label>
              <input type="text" name="filetext1" placeholder="Tuliskan judul file" class="form-control" />
              
              <input type="file" accept=".pdf, .docx, .doc, .csv, .xls, .xlsx, .txt, .jpg, .jpeg, .png"  class="form-control" name="file1" id="file1" >
              <small id="file1" class="form-text text-muted">Max. 2MB. Ekstensi yang diperbolehkan pdf, docx, doc, csv, xls, xlsx, txt, jpg, jpeg, dan png</small>
            </div>
          </div>
          <span class="btn btn-primary" id="morefile"><i class="fas fa-plus"></i> Tambah File</span>
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