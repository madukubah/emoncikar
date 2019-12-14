<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover  ">
        <thead style="font-size:12px" >
            <tr>
                <td colspan="12" align="center"><strong id="physical_planning_message" >Rencana Fisik</strong></td>
            </tr>
            <tr>
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
            <tr id="physical_planning_status" >
                <?php foreach( [ 'jan' ,'feb' ,'mar' ,'apr' ,'mei' ,'jun' ,'jul' ,'ags' ,'sep' ,'okt' ,'nov' ,'des' ] as $ind => $value ):?>
                        <td >
                            <input type="number" min="0" class="physical_plan" name="physical_plan[]" value="<?= $a = ( isset( $physical_plan ) ? $physical_plan->$value/1 : 0  )?>" >
                        </td>
                <?php endforeach;?>
            </tr>
            <?php 
                endforeach;
            ?>
        </tbody>
    </table>
</div>