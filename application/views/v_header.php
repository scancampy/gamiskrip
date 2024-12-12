<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $setting->web_name; ?> | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('dist/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">

<!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('dist/plugins/summernote/summernote-bs4.min.css'); ?>">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('dist/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('dist/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('dist/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('dist/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css'); ?>">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo base_url('dist/css/custom.css'); ?>">
</head>
<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?php echo base_url('dist/img/AdminLTELogo.png'); ?>" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('dashboard'); ?>" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('dashboard'); ?>" class="brand-link">
      <img src="<?php echo base_url('dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $setting->web_name; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <?php if($userjson->avatar_image_url != '') { ?>
        <div class="image" id="sidebarpropic" style="width:2.1em; height: 2.1em; border-radius: 50%; margin-left: auto; margin-right: auto;
                background: url('<?php if($userjson->avatar_image_url) { echo $userjson->avatar_image_url; } else { echo '';  } ?>');  background-size: 270%;
                background-position: center 20%;
                background-color: gray;
    background-repeat: no-repeat;  " >
          
        </div>
      <?php }  else { ?>
        <img class="img-circle img-bordered-sm" src="<?php echo base_url('images/assets/propic_blank.jpg');  ?>" alt="user image">
      <?php } ?>
        <div class="info" style="flex-grow: 1;">
          <a href="<?php echo base_url('myprofile/ubahavatar'); ?>" class="d-block"><?php echo $userjson->first_name.' '.$userjson->last_name;
 ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'dashboard') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>

          <li class="nav-item menu-is-opening menu-open">
            <a href="#" class="nav-link <?php if($this->uri->segment(1) == 'tugasakhir') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Skripsi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: block;">
              <?php if($userjson->user_type =='student') { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('tugasakhir'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'tugasakhir' && !$this->uri->segment(2)) { echo 'active'; } ?>">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Data Skripsi
                  </p>
                </a>
              </li>
              <?php } ?>

              <?php if($userjson->user_type =='lecturer') { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('tugasakhir/bimbinganku'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'tugasakhir' && ($this->uri->segment(2) == 'bimbinganku' || $this->uri->segment(2) == 'logbimbinganku')) { echo 'active'; } ?>">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Bimbinganku
                  </p>
                </a>
              </li>
              <?php } ?>

              <?php if($userjson->user_type =='student') { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('tugasakhir/progress'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'progress') { echo 'active'; } ?>">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Progress Skripsi
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('tugasakhir/logbimbingan'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'logbimbingan') { echo 'active'; } ?>">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Log Bimbingan
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url('tugasakhir/weeklyplanner'); ?>" class="nav-link <?php if($this->uri->segment(2) == 'weeklyplanner') { echo 'active'; } ?>">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Weekly Planner
                  </p>
                </a>
              </li>
              
              <?php } ?>
            </ul>
          </li>

          <?php if($userjson->user_type =='student') { ?>
          <li class="nav-item">
            <a href="<?php echo base_url('thejourney'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'thejourney') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-map-signs"></i>
              <p>
                The Journey
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="<?php echo base_url('quest'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'quest') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Quest
              </p>
            </a>
          </li>
          <?php } ?>

          
          <li class="nav-item">
            <a href="<?php echo base_url('thesis/recommender'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'thesis') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Sistem Rekomendasi
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="<?php echo base_url('diskusi/home'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'diskusi') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Ruang Diskusi
              </p>
            </a>
          </li>

          <?php if($userjson->user_type =='student') { ?>
          <li class="nav-item">
            <a href="<?php echo base_url('myclan'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'myclan') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                My Clan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('timeline'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'timeline') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-stream"></i>
              <p>
                Timeline
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('leaderboard'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'leaderboard') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-splotch"></i>
              <p>
                Leaderboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('achievements'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'achievements') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-ribbon"></i>
              <p>
                Achievements
              </p>
            </a>
          </li>
        <?php } ?>
          

          <li class="nav-item" style="    border-top: 1px solid #4f5962">
            <a href="<?php echo base_url('dashboard/signout'); ?>" class="nav-link">
              <i class="nav-icon fas fa-door-open"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>