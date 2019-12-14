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
              <?php echo (isset($physical)) ? $physical : '';  ?>
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
        var _rpm = false;
        var _pln = false;
        var _physical = false;
        $(".budget_plan_rpm").keyup(function(){
            _rpm = check( 'budget_plan_rpm', 'ceiling_rpm' );
            _pln = check( 'budget_plan_pln', 'ceiling_pln' );
            validation();
        });
        $(".budget_plan_pln").keyup(function(){
            _rpm = check( 'budget_plan_rpm', 'ceiling_rpm' );
            _pln = check( 'budget_plan_pln', 'ceiling_pln' );
            validation();
        });
        $(".physical_plan").keyup(function(){
            _rpm = check( 'budget_plan_rpm', 'ceiling_rpm' );
            _pln = check( 'budget_plan_pln', 'ceiling_pln' );
            _physical = physical_check();
            validation();
        });
        
        function validation()
        {
            if(  _rpm && _pln && _physical ) $("#submit_do").attr("disabled", false);
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
            balance( 'ceiling_pln', 'ceiling_rpm' );
            _rpm = check( 'budget_plan_rpm', 'ceiling_rpm' );
            _pln = check( 'budget_plan_pln', 'ceiling_pln' );
            validation();
        });
        $("#ceiling_pln").keyup(function(){
            balance( 'ceiling_pln', 'ceiling_rpm' );
            _rpm = check( 'budget_plan_rpm', 'ceiling_rpm' );
            _pln = check( 'budget_plan_pln', 'ceiling_pln' );
            validation();
        });
        $("#ceiling_rpm").keyup(function(){
            balance( 'ceiling_rpm', 'ceiling_pln' );
            _rpm = check( 'budget_plan_rpm', 'ceiling_rpm' );
            _pln = check( 'budget_plan_pln', 'ceiling_pln' );
            validation();
        });

        // BALANCE
        function balance( cuur_element, element )
        {
            var ceiling_budget = $("#ceiling_budget").val();
            var _cuur_element = $("#"+cuur_element).val(  );

            if( ceiling_budget == '' ) ceiling_budget = '0';
            if( _cuur_element == '' ) _cuur_element = '0';
            ceiling_budget  = parseInt( ceiling_budget );
            _cuur_element   = parseInt( _cuur_element );

            $("#"+element).val( ceiling_budget - _cuur_element );

        }

        // PHYSICAL
        function physical_check(  )
        {
            var sum_ = physical_sum(  );
            
            $( "#physical_planning_message"  ).html( "Rencana Fisik | "+ ( 100 - sum_  )  );
            if( sum_ > 100 )
            {
                $( "#physical_planning_status" ).attr("class", "bg-danger");
                return false;
                // alert("Lebih");
            }
            else 
            if( sum_ == 100 )
            {
                $( "#physical_planning_status" ).attr("class", "bg-success");
                return true;
            }else{
                $( "#physical_planning_status" ).attr("class", "bg-warning");
                return false;
            }
        }
        function physical_sum( curr_class )
        {
            var sum = 0;
            for( var i =0; i< $( ".physical_plan"  ).length; i++  )
            {
                var num = $( ".physical_plan" ).eq( i ).val()
                if( num != '' )
                    sum += parseInt( num );
            }
            return sum;
        }
        if(  $("#ceiling_rpm").val() =='0' )
          $("#ceiling_rpm").val( $("#ceiling_budget").val() ) ;//= $("#ceiling_budget").val();

        _rpm = check( 'budget_plan_rpm', 'ceiling_rpm' );
        _pln = check( 'budget_plan_pln', 'ceiling_pln' );
        _physical = physical_check();
        validation();
    });
</script>