<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover  ">
        <thead style="font-size:12px" >
            <tr>
                <td rowspan="2" align="center" ><strong>No</strong></td>
                <td rowspan="2" align="center" ><strong>Kode</strong></td>
                <td rowspan="2" align="center" ><strong>Paket Pekerjaan</strong></td>
                <td colspan="2" align="center" ><strong>Koordinat</strong></td>
                <td colspan="5" align="center" ><strong>Foto</strong></td>
                <td rowspan="2" align="center" ><strong>Keterangan</strong></td>
                <!-- <td rowspan="2" align="center" >&nbsp;</td> -->
            </tr>
            <tr>
                <td align="center" ><strong>Longitude</strong></td>
                <td align="center" ><strong>Latitude</strong></td>
                <td align="center" ><strong>0%</strong></td>
                <td align="center" ><strong>25%</strong></td>
                <td align="center" ><strong>50%</strong></td>
                <td align="center" ><strong>75%</strong></td>
                <td align="center" ><strong>100%</strong></td>
            </tr>
        </thead>
        <tbody style="font-size:12px" >
            <?php 
                $no =  ( isset( $number ) && ( $number != NULL) )  ? $number : 1 ;
                foreach( $rows as $ind => $row ):
            ?>
            <tr >
                <td> <?php echo $no ++ ?> </td>
                <?php foreach( $header as $key => $value ):?>
                        <td >
                            <?php
                                $attr = "";
                                if( is_numeric( $row->$key ) && ( $key != 'phone' && $key != 'username' && $key != 'code' && $key != 'year' ) )
                                    $attr = number_format( $row->$key );
                                else
                                    $attr = $row->$key ;
                                if( $key == 'date' || $key == 'create_date' || $key == 'time' )
                                    $attr =  date("d/m/Y", $row->$key ) ;
                                if( $key == 'month' && is_numeric( $row->$key )  )
                                    $attr = Util::MONTH[ $row->$key ] ;
                                echo $attr;
                            ?>
                        </td>
                <?php endforeach;?>
            </tr>
            <?php 
                endforeach;
            ?>
        </tbody>
    </table>
</div>