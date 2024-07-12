<div class="card card-primary card-outline">
    <div class="card-body box-profile">
      
      <dl>
        <dt><?php echo $tugasakhir[0]->judul; ?></dt>
        <dd><?php echo $tugasakhir[0]->f1; ?> &amp; <?php echo $tugasakhir[0]->f2; ?></dd>
        <dd><?php echo strftime("%d %B %Y", strtotime($tugasakhir[0]->tanggal_akhir_st));
            $datetime2 = date_create(date('Y-m-d'));
            $datetime1 = date_create($tugasakhir[0]->tanggal_akhir_st);
            $interval = date_diff($datetime1, $datetime2);

            if($datetime1 > $datetime2) {
              $months = $interval->m;
              $days = $interval->d;
              $label = '';
              
              if($months > 0) {
                $label .= $months.' bulan ';
              }

              if($days > 0) {
                $label .= $days.' hari';
              }
              $label .= ' tersisa';

              if($months < 2) {
                 echo ' <span class="badge badge-warning">'; 
              } else {
                 echo ' <span class="badge badge-primary">';
              }

              echo $label.'</span>';
             
            } else {
              echo ' <span class="badge badge-danger">ST berakhir</span>';
            }
        
            
            ?></dd>
        
      </dl>
      
    </div>
    <!-- /.card-body -->
  </div>
