<!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url('dist/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('dist/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Select2 -->
<script src="<?php echo base_url('dist/plugins/select2/js/select2.full.min.js'); ?>"></script>

<!-- DataTables  & Plugins -->
<script src="<?php echo base_url('dist/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/jszip/jszip.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/pdfmake/pdfmake.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/pdfmake/vfs_fonts.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>

<!-- bs-custom-file-input -->
<script src="<?php echo base_url('dist/plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('dist/js/adminlte.min.js'); ?>"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url('dist/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

<script type="text/javascript">
  $(document).ready(function() {
    <?php if(!empty($js)) { echo $js; } ?>
  });

</script>
</body>
</html>