<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover  ">
        <thead style="font-size:12px" >
            <tr>
                <td colspan="13" align="center" ><strong id="budget_message" >Rencana Keuangan ( Ribu ) </strong></td>
            </tr>
            <tr>
                <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </td>
                <td align="center" ><strong>Jan</strong></td>
                <td align="center" ><strong>Feb</strong></td>
                <td align="center" ><strong>Mar</strong></td>
                <td align="center" ><strong>Apr </strong></td>
                <td align="center" ><strong>Mei </strong></td>
                <td align="center" ><strong>Jun</strong></td>
                <td align="center" ><strong>Jul</strong></td>
                <td align="center" ><strong>Ags</strong></td>
                <td align="center" ><strong>Sep</strong></td>
                <td align="center" ><strong>Okt</strong></td>
                <td align="center" ><strong>Nov</strong></td>
                <td align="center" ><strong>Des</strong></td>
            </tr>
        </thead>
        <tbody style="font-size:12px" >
            <?php 
                $no =  ( isset( $number ) && ( $number != NULL) )  ? $number : 1 ;
                foreach( [1] as $ind => $row ):
            ?>
            <tr id="budget_plan_rpm_status"  >
                <td>
                    <strong  >
                        RPM | Sisa <div id="budget_plan_rpm_message" >  </div>
                    </strong>
                </td>    
                <?php foreach( [ 'jan' ,'feb' ,'mar' ,'apr' ,'mei' ,'jun' ,'jul' ,'ags' ,'sep' ,'okt' ,'nov' ,'des' ] as $ind => $value ):?>
                        <td >
                            <input type="number" min="0" class="budget_plan_rpm" name="budget_plan_rpm[]" value="<?= $a = ( isset( $budget_plan_rpm ) ? $budget_plan_rpm->$value : 0  )?>" >
                        </td>
                <?php endforeach;?>
            </tr>
            <tr id="budget_plan_pln_status"  >
                <td>
                    <strong  >
                        PLN | Sisa <div id="budget_plan_pln_message" >  </div>
                    </strong>
                </td>  
                <?php foreach( [ 'jan' ,'feb' ,'mar' ,'apr' ,'mei' ,'jun' ,'jul' ,'ags' ,'sep' ,'okt' ,'nov' ,'des' ] as $ind => $value ):?>
                        <td >
                            <input type="number" min="0" class="budget_plan_pln" name="budget_plan_pln[]" value="<?= $a = ( isset( $budget_plan_pln ) ? $budget_plan_pln->$value : 0  )?>" >
                        </td>
                <?php endforeach;?>
            </tr>
            <?php 
                endforeach;
            ?>
        </tbody>
    </table>
</div>
 