<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Welcome to Gamiskrip</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Cluster</li>
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
                <div class="col-md-12">
                  
                  <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Cluster</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="<?php echo base_url('dashboard/edit_cluster/'.$cluster->id); ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text"  class="form-control" id="id" name="id" value="<?php echo $cluster->id; ?>">
                  </div>
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $cluster->title; ?>">
                  </div>
                  <div class="form-group">
                    <label for="abstrak">Abstrak</label>
                    <textarea class="form-control" id="abstrak" name="abstrak"><?php echo $cluster->abstrak; ?>
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="supervisor1">Supervisor 1</label>
                    <select class="form-control" id="supervisor1" name="supervisor1">
                      <option value="">[Choose Lecturer]</option>
                      <?php foreach ($lecturer as $key => $value) { ?>
                        <option value="<?php echo $value->npk; ?>" <?php if($cluster->supervisor1 == $value->npk) { echo 'selected'; } ?>><?php echo $value->name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="supervisor2">Supervisor 2</label>
                    <select class="form-control" id="supervisor2" name="supervisor2">
                      <option value="">[Choose Lecturer]</option>
                      <?php foreach ($lecturer as $key => $value) { ?>
                        <option value="<?php echo $value->npk; ?>" <?php if($cluster->supervisor2 == $value->npk) { echo 'selected'; } ?>><?php echo $value->name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" value="submit" name="btnsubmit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
                  
                </div>

              </div>
              <!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->