<div class="modal fade" id="modal-quest-rating">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
       
        <div class="modal-header">
          <h4 class="modal-title">Rating Quest</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <strong id="labelquest"></strong>
            <div class="container mt-5">
                <div class="star-rating">
                    <i class="fa fa-star star" data-value="1"></i>
                    <i class="fa fa-star star" data-value="2"></i>
                    <i class="fa fa-star star" data-value="3"></i>
                    <i class="fa fa-star star" data-value="4"></i>
                    <i class="fa fa-star star" data-value="5"></i>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" id="qid" name="qid"/>
          <button type="button" class="btn btn-primary" name="btnsubmitrating" id="btnsubmitrating" value="submit">Submit Rating</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <style>
        .star-rating {
            display: inline-flex;
            direction: row;
            cursor: pointer;
        }
        .star {
            font-size: 2rem;
            color: gray;
        }
        .star.checked {
            color: gold;
        }
    </style>


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

<!-- ChartJS -->
<script src="<?php echo base_url('plugins/chart.js/Chart.min.js'); ?>"></script>
<!-- AdminLTE App -->

<!-- SweetAlert2 -->
<script src="<?php echo base_url('dist/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

<!-- AdminLTE for demo purposes -->

<?php if($js) { ?>
<script type="text/javascript">
  $(document).ready(function() {
      let rating = 1;
      $('.star').on('click', function() {
          rating = $(this).data('value'); // Get the rating from the clicked star
          $('.star').removeClass('checked');  // Remove the checked class from all stars
          // Add checked class to all stars with a data-value <= the clicked star's value
          $('.star').each(function() {
              if ($(this).data('value') <= rating) {
                  $(this).addClass('checked');
              }
          });
          console.log(`Rating selected: ${rating}`);
      });

      $('#btnsubmitrating').on('click', function(e) {
        $.post("<?php echo base_url('quest/submitrating'); ?>", { id:$("#qid").val(), ratingsel: rating }, function(data) {
          console.log(data);
          $("#modal-quest-rating").modal("hide");
        });
      });
  });

  <?php echo $js; ?>    
</script>
<?php } ?>
<script type="text/javascript">
  <?php if($this->session->flashdata('showonboarding')) { ?>
    $(document).ready(function() {
          var onboarding_content = 1;
          var onboarding_content_total = $('.onboarding-content').length; 
          console.log(onboarding_content_total);
          $('#onboarding-dialog').modal('show');

          $("body").on("click", "#onboarding-next-button", function() {            
            $("#onboarding-content-" + onboarding_content).hide();
            onboarding_content++;
            $("#onboarding-content-" + onboarding_content).show();

            if(onboarding_content >= onboarding_content_total) {
              $("#onboarding-next-button").hide();
            }
          });
      });
  <?php } ?>
</script>
</body>
</html>