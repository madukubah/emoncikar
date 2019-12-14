<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover  ">
        <thead style="font-size:12px" >
            <tr>
                <td rowspan="2" align="center" ><strong>No</strong></td>
                <td rowspan="2" align="center" ><strong>Kode</strong></td>
                <td rowspan="2" align="center" ><strong>Program/Kegiatan/Output/Paket/Sub Paket </strong></td>
                <td rowspan="2" align="center" ><strong>AU/<br>
                F/<br>
                NF</strong></td>
                <td rowspan="2" align="center" ><strong>AU/<br>
                K/<br>
                S</strong></td>
                <td rowspan="2" align="center" ><strong>Pagu<br>
                    <!-- Akun<br> -->
                    (Rp Ribu) </strong></td>
                <!-- <td rowspan="2" align="center" ><strong>Pagu<br>
                    Rencana<br>
                (Rp Ribu) </strong></td> -->
                <td colspan="12" align="center" ><strong> <?= ( isset( $month_header ) ? $month_header : "" )?>  </strong></td>
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