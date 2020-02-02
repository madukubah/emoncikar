<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark"><?php echo $block_header ?></h5>
          <a href="<?php echo $url_back  ?>" class="btn  btn-sm btn-warning waves-effect" >Kembali </a>

        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">  
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="col-12">
                <?php
                echo $alert;
                ?>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                  <h5>
                    <?php echo strtoupper($header) ?>
                    <p class="text-secondary"><small><?php echo $sub_header ?></small></p>
                  </h5>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                      <div class="float-right">
                        <?php echo (isset($header_button)) ? $header_button : '';  ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!--  -->
              <?php echo (isset($contents)) ? $contents : '';  ?>
              <!--  -->
            </div>
          </div>
        </div>
        <!-- PLANNING -->
        <div class="col-12">
          <div class="card">
            <div class="card-header bg-info">
              <div class="col-12">
                <?php
                // echo $alert;
                ?>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                  <h5>
                    <?php echo strtoupper( "Rencana" ) ?>
                    <p class="text-secondary"><small><?php echo $sub_header ?></small></p>
                  </h5>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                      <div class="float-right">
                        <?php echo (isset($b)) ? $b : '';  ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!--  -->
              <?php echo (isset($planning_table)) ? $planning_table : '';  ?>
              <!--  -->
            </div>
          </div>
          <!-- Realisasi -->
          <div class="card">
            <div class="card-header bg-success">
              <div class="col-12">
                <?php
                // echo $alert;
                ?>
              </div>
              <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 ">
                  <h5>
                    <?php echo strtoupper( "Realisasi" ) ?>
                    <p class="text-secondary"><small><?php echo $sub_header ?></small></p>
                  </h5>
                </div>
                <div class="col-10">
                  <div class="row">
                    <div class="col-12">
                      <div class="float-right">
                        <ul class="row nav nav-pills  p-2">
                          <li class="col text-center nav-item">
                            <a class="nav-link active text-white " href="#tab_1" data-toggle="tab" id="house" >
                              Lihat </a>
                          </li>
                          <li class="col  text-center nav-item">
                            <a class="nav-link text-white " href="#tab_2" data-toggle="tab" id="no_house" >
                              Edit 
                            </a>
                          </li>
                          <li>
                          </li>
                        </ul>
                        <!-- <?php echo (isset($a)) ? $a : '';  ?> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <?php echo (isset($realization_table)) ? $realization_table : '';  ?>
                </div>
                <div class="tab-pane" id="tab_2">
                    <!--  -->
                    <?php echo form_open();  ?>
                    <?php echo (isset($planning)) ? $planning : '';  ?>
                    <br>
                    <button id="submit_do" class="btn btn-bold btn-success btn-sm " style="margin-left: 5px;" type="submit">
                      Simpan
                    </button>

                    <?php echo form_close()  ?>
                    <!--  -->
                </div>
              </div>
              <!--  -->
              <!--  -->
            </div>
          </div>
          <!--  -->
          <!-- photo -->
          <div class="card">
            <div class="card-header">
              <div class="col-12">
                <?php
                // echo $alert;
                ?>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                  <h5>
                    <?php echo strtoupper( "Foto Progress" ) ?>
                    <p class="text-secondary"><small><?php echo $sub_header ?></small></p>
                  </h5>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                      <div class="float-right">
                        <?php echo (isset($b)) ? $b : '';  ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!--  -->
              <!-- IMAGE -->
              <div class="row">
                  <?php
                    $title = ["0%", "25%", "50%", "75%", "100%" ];
                    // $images = explode(";", $activity->images);
                    foreach ( $images_arr as $i => $image) :
                  ?>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                      <div class="card"  >
                        <div class="card-body">
                          <label for=""> <?= $title[$i] ?> </label>
                          <a href="" data-toggle="modal" data-target="#image<?php echo  $activity->id . $i; ?>">
                            <img class=" img-fluid" src="<?php echo $image->image_url  ?>" alt="" height="auto" width="500">
                          </a>
                          <div class="modal fade" id="image<?php echo  $activity->id . $i; ?>" role="dialog">
                            <div class="modal-dialog modal-xl " style="overflow: hidden">
                              <img class=" img-fluid" src="<?php echo $image->image_url  ?>" alt="" height="auto" width="1500">
                            </div>
                          </div>
                          <br>
                          <br>
                          <!--  -->
                          <?= $images_arr[$i]->edit_photo_html ?>
                          <!--  -->
                          <br>
                        </div>
                      </div>
                    </div>
                  <?php
                  endforeach;
                  ?>
              </div>
              <!--  -->
            </div>
          </div>
          <!-- problem -->
          <div class="card">
            <div class="card-header">
              <div class="col-12">
                <?php
                // echo $alert;
                ?>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                  <h5>
                    <?php echo strtoupper( "permasalahan" ) ?>
                    <p class="text-secondary"><small><?php echo $sub_header ?></small></p>
                  </h5>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                      <div class="float-right">
                        <?php echo (isset($problem_header)) ? $problem_header : '';  ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!--  -->
              <?php echo (isset($problem_table)) ? $problem_table : '';  ?>
              <!--  -->
            </div>
          </div>
          <!-- // create report -->
          <div class="card">
              <div class="card-body">
                  <a href="<?php echo site_url("uadmin/activity/print_pdf/").$activity->id ?>" class="btn  btn-md btn-success waves-effect" target="_blank">Cetak Laporan </a>
              </div> 
          </div>
          <!--  -->
        </div>
        <!-- /PLANNING -->
      </div>
    </div>
  </section>
</div>
<script>
    $(document).ready(function() {
        var _budget = false;
        var _physical = false;
        $(".budget").keyup(function(){
           _budget = check( 'budget', 'ceiling_budget' );
            validation();
        });
        $(".physical").keyup(function(){
            _physical = physical_check();
            validation();
        });
        
        function validation()
        {
            // if(  _budget && _physical ) $("#submit_do").attr("disabled", false);
            // else $("#submit_do").attr("disabled", true);
        }

        function check( curr_class, ceiling_budget_id )
        {
            var ceiling_budget = $( "#"+ ceiling_budget_id ).val();
            if( ceiling_budget == '' ) ceiling_budget = '0';
            ceiling_budget = parseInt( ceiling_budget );

            // console.log( ceiling_budget );
            var sum_ = sum( curr_class );
            
            $( "#"+curr_class+"_message"  ).html(  ( ceiling_budget - sum_  )  );

            if( sum_ > ceiling_budget )
            {
                $( "#"+curr_class+"_status" ).attr("class", "bg-danger");
                return false;
                // alert("Lebih");
            }
            else 
            if( sum_ == ceiling_budget )
            {
                $( "#"+curr_class+"_status" ).attr("class", "bg-success");
                return true;
            }else{
                $( "#"+curr_class+"_status" ).attr("class", "bg-warning");
                return false;
            }
        }
        function sum( curr_class )
        {
            var sum = 0;
            for( var i =0; i< $( "." + curr_class ).length; i++  )
            {
                var num = $( "." + curr_class ).eq( i ).val()
                if( num != '' )
                    sum += parseInt( num );
            }
            return sum;
        }

        $("#ceiling_budget").keyup(function(){
           _budget = check( 'budget', 'ceiling_budget' );
            validation();
        });

        // PHYSICAL
        function physical_check(  )
        {
            var sum_ = physical_sum(  );
            
            $( "#physical_message"  ).html( ( 100 - sum_  )  );
            if( sum_ > 100 )
            {
                $( "#physical_status" ).attr("class", "bg-danger");
                return false;
                // alert("Lebih");
            }
            else 
            if( sum_ == 100 )
            {
                $( "#physical_status" ).attr("class", "bg-success");
                return true;
            }else{
                $( "#physical_status" ).attr("class", "bg-warning");
                return false;
            }
        }
        function physical_sum( curr_class )
        {
            var sum = 0;
            for( var i =0; i< $( ".physical"  ).length; i++  )
            {
                var num = $( ".physical" ).eq( i ).val()
                if( num != '' )
                    sum += parseInt( num );
            }
            return sum;
        }
        
       _budget = check( 'budget', 'ceiling_budget' );
        _physical = physical_check();
        validation();
    });
</script>