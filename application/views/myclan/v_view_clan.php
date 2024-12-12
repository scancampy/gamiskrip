<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">View Clan</h1>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('myclan/viewclan/'.$clanid.'/'.$clan[0]->nama); ?>"><?php echo $clan[0]->nama; ?></a></li>
              
            </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
          <!-- Main content -->
          <div class="content">
            <div class="row">
              <div class="container mt-1">
                 <!-- Date Period -->
    <div class="row mb-4">
        <div class="col-12 text-center">
          <img src="<?php echo base_url('images/assets/clan_'.$clanid.'.jpg'); ?>" style="max-width: 100px;" />
            <h3><?php echo $clan[0]->nama; ?></h3>
        </div>
    </div>
              <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card ">
              <div class="card-body">
                <div class="d-flex">
                  <div class="col-md-3">
                    <img src="<?php echo base_url('images/assets/clan_'.$clanid.'_pic.jpg'); ?>" class="img-fluid"/>
                  </div>
                  <div class="col-md-9">
                    <div class="row">
                      <div class="col-xs-12 col-md-12"><?php echo $clan[0]->nama; ?>. 
                        <?php echo $clan[0]->description; ?>
                        <br/><strong>Jumlah anggota: <?php echo count($clan_members); ?></strong>
                      </div>
                    </div>  
                    <div class="row">
                      <div class="col mt-2">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>NRP</th>
                              <th>Nama</th>
                              <th>Points</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($clan_members as $key => $value) { ?>
                              <tr>
                                <td><a href="<?php echo base_url('myprofile/viewprofile/'.$value->nrp); ?>"><?php echo $value->nrp; ?></a></td>
                                <td><a href="<?php echo base_url('myprofile/viewprofile/'.$value->nrp); ?>"><?php echo $value->fullname; ?></a></td>
                                <td><?php if($value->total_points == NULL) { echo "0"; } else { echo $value->total_points; } ?></td>
                              </tr>
                            <?php } ?>
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
        </div>
            </div>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->