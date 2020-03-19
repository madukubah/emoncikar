<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $a = ( isset( $activity_count )  ) ? number_format( $activity_count ) : 0  ?></h3>

                <p>Kegiatan</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-people"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $a = ( isset( $total_budget_plan )  ) ? number_format( $total_budget_plan ) : 0  ?></sup></h3>

                <p>Total Rencana Anggaran</p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4  col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $a = ( isset( $total_budget_realization )  ) ? number_format( $total_budget_realization ) : 0  ?></sup></h3>

                <p>Total Realisasi Anggaran</p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-white">
              <div class="inner">
                <h3><?= $a = ( isset( $year_budget_plan )  ) ? number_format( $total_budget_plan ) : 0  ?></sup></h3>

                <p>Rencana Anggaran Tahun <?= $year?></p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6  col-md-6 col-12">
            <!-- small box -->
            <div class="small-box bg-light">
              <div class="inner">
                <h3><?= $a = ( isset( $year_budget_realization )  ) ? number_format( $total_budget_realization ) : 0  ?></sup></h3>

                <p>Realisasi Anggaran Tahun <?= $year?></p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-12">
            <!-- small box -->
            <div class="card">
              <div class="card-header">
                <h5>
                  Kurva S
                </h5>
              </div>
              <div class="card-body">
                <?php echo (isset($contents)) ? $contents : '';  ?>
                <div class="row">
                  <!-- col -->
                  <div class="col-lg-6  col-md-6 col-12">
                    <?php echo (isset($budget_chart)) ? $budget_chart : '';  ?>
                  </div>
                  <!-- col -->
                  <div class="col-lg-6  col-md-6 col-12">
                    <?php echo (isset($physical_chart)) ? $physical_chart : '';  ?>
                  </div>
                </div>
                <!--  -->
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>