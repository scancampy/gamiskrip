
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
<!-- jQuery Mapael -->
<script src="<?php echo base_url('dist/plugins/jquery-mousewheel/jquery.mousewheel.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/raphael/raphael.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/jquery-mapael/jquery.mapael.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/plugins/jquery-mapael/maps/usa_states.min.js'); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('dist/plugins/chart.js/Chart.min.js'); ?>"></script>

<!-- SweetAlert2 -->
<script src="<?php echo base_url('dist/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

<!-- AdminLTE for demo purposes -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('dist/js/pages/dashboard2.js'); ?>"></script>

<?php if($js) { ?>
<script type="text/javascript">
  <?php echo $js; ?>    
</script>
<?php } ?>

</body>
</html>