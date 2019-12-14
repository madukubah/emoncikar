<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h5 class="m-0 text-center text-dark"><?php echo $block_header ?></h5>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!--  -->
          <div class="card">
            <div class="card-header  p-0">
              <!-- <h3 class="card-title p-3">Tabs</h3> -->
              <ul class="row nav nav-pills  p-2">
                <li class="col text-center nav-item">
                  <a class="nav-link <?= ( $code== "recap")? "active": "" ?>" href="<?= $tab_url?>?code=recap" >
                    Rekapitulasi Paket</a>
                </li>
                <!-- <li class="col text-center nav-item">
                  <a class="nav-link <?= ( $code== "contractual")? "active": "" ?>" href="<?= $tab_url?>?code=contractual" >
                    Kontraktual
                  </a>
                </li> -->
                <!-- <li class="col text-center nav-item">
                  <a class="nav-link <?= ( $code== "spse_package")? "active": "" ?>" href="<?= $tab_url?>?code=spse_package" >
                  Data Paket SPSE
                  </a>
                </li> -->
                <li class="col text-center nav-item">
                  <a class="nav-link <?= ( $code== "chart")? "active": "" ?>" href="<?= $tab_url?>?code=chart" >
                    Kurva-S
                  </a>
                </li>
                <li class="col text-center nav-item">
                  <a class="nav-link <?= ( $code== "budget_planning")? "active": "" ?>" href="<?= $tab_url?>?code=budget_planning" >
                    Rencana Keuangan
                  </a>
                </li>
                <li class="col text-center nav-item">
                  <a class="nav-link <?= ( $code== "physical_planning")? "active": "" ?>" href="<?= $tab_url?>?code=physical_planning" >
                    Rencana Fisik
                  </a>
                </li>
                <li class="col text-center nav-item">
                  <a class="nav-link <?= ( $code== "galleries")? "active": "" ?>" href="<?= $tab_url?>?code=galleries" 
                    >Foto Progress
                  </a>
                </li>
                <li class="col text-center nav-item">
                  <a class="nav-link <?= ( $code== "problem")? "active": "" ?>" href="<?= $tab_url?>?code=problem" >
                    Permasalahan
                  </a>
                </li>
              
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <?php echo (isset($contents)) ? $contents : '';  ?>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!--  -->
        
        </div>
      </div>
    </div>
  </section>
</div>