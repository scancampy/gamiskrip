
  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022-<?php echo date('Y'); ?> <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo base_url('dist/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url('dist/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('dist/js/adminlte.js'); ?>"></script>

<!-- PAGE PLUGINS -->

<script src="<?php echo base_url('dist/plugins/inputmask/jquery.inputmask.min.js'); ?>"></script>

<!-- ChartJS -->
<script src="<?php echo base_url('dist/plugins/chart.js/Chart.min.js'); ?>"></script>

<!-- DataTables  & Plugins -->
<script src="<?php echo base_url('dist/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>

<script src="<?php echo base_url('dist/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('dist/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
<!-- AdminLTE App -->

<!-- SweetAlert2 -->
<script src="<?php echo base_url('dist/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

<!-- AdminLTE for demo purposes -->

<?php if($js) { ?>
<script type="text/javascript">
  <?php echo $js; ?>    
</script>
<?php } ?>

</body>
</html>