<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark"><?php echo $block_header ?></h5>
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
                <div class="col-6">
                  <h5>
                    <?php echo strtoupper($header) ?>
                    <p class="text-secondary"><small><?php echo $sub_header ?></small></p>
                  </h5>
                </div>
                <div class="col-6">
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
              <?php echo form_open();  ?>
              <?php echo (isset($contents)) ? $contents : '';  ?>
              <?php echo (isset($planning)) ? $planning : '';  ?>
              <br>
              <button id="submit_do" class="btn btn-bold btn-success btn-sm " style="margin-left: 5px;" type="submit">
                Simpan
              </button>

              <?php echo form_close()  ?>
              <!--  -->
            </div>
          </div>
        </div>
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
            if(  _budget && _physical ) $("#submit_do").attr("disabled", false);
            else $("#submit_do").attr("disabled", true);
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