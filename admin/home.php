
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<h1>Welcome to <?php echo $_settings->info('name') ?> - Management Site</h1>
<hr>
<div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Members</span>
            <span class="info-box-number">
              <?php 
                $member = $conn->query("SELECT * FROM member_list")->num_rows;
                echo format_num($member);
              ?>
              <?php ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-briefcase"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Services</span>
          <span class="info-box-number">
            <?php 
              $posts = $conn->query("SELECT * FROM post_list")->num_rows;
              echo format_num($posts);
            ?>
            <?php ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-exclamation-circle "></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Reclamations</span>
            <span class="info-box-number">
              <?php 
                $member = $conn->query("SELECT * FROM `coin_list` WHERE STATUS=4 or status=7;
                ")->num_rows;
                echo format_num($member);
              ?>
              <?php ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
              <canvas id="reclamationsChart" width="100" height="100"></canvas>

</div>

