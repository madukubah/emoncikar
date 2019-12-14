<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover  ">
        <thead style="font-size:12px" >
            <tr>
                <td rowspan="3" align="center" ><strong>No</strong></td>
                <td rowspan="3" align="center" ><strong>Kode</strong></td>
                <td rowspan="3" align="center" ><strong>Program/Kegiatan/Output/Paket/Sub Paket </strong></td>
                <td rowspan="3" align="center" ><strong>Lokasi</strong></td>
                <td colspan="2" align="center" ><strong>Target</strong></td>
                <td rowspan="3" align="center" ><strong>AU/<br>
                    F/<br>
                    NF</strong>
                </td>
                <td rowspan="3" align="center" >
                    <strong>AU<br>
                            P/<br>
                            L/<br>
                            K/<br>
                            S</strong>
                </td>
                <!-- <td colspan="5" align="center" > -->
                <td colspan="3" align="center" >
                    <strong>Pagu <br>
                        (Rp Ribu) </strong>
                </td>
                <td colspan="3" align="center" ><strong>Realisasi</strong><br>
                (<strong>Rp Ribu</strong>)</td>
                <td colspan="2" align="center" ><strong>Progres<br>
                (%) </strong></td>
                <td rowspan="3" align="center" ><strong>Pagu Blokir</strong></td>
                <td rowspan="3" align="center" ><strong>Keterangan</strong></td>
            </tr>
            <tr>
                <td rowspan="2" align="center" ><strong>Kuantitas</strong></td>
                <td rowspan="2" align="center" ><strong>Satuan</strong></td>
                <!--  -->
                <td align="center" ><strong>RPM</strong></td>
                <td align="center" ><strong>PLN</strong></td>
                <td align="center" ><strong>TOTAL</strong></td>
                <!--  -->
                <!-- <td colspan="3" align="center" ><strong>Akun</strong></td> -->
                <!-- <td rowspan="2" align="center" ><strong>Paket</strong></td>
                <td rowspan="2" align="center" ><strong>Rencana <br>
                Pengadaan</strong></td> -->
                <td rowspan="2" align="center" ><strong>RPM</strong></td>
                <td rowspan="2" align="center" ><strong>PLN</strong></td>
                <td rowspan="2" align="center" ><strong>TOTAL</strong></td>
                <td rowspan="2" align="center" ><strong>Keu</strong></td>
                <td rowspan="2" align="center" ><strong>Fisik</strong></td>
            </tr>
            <!-- <tr>
                <td align="center" ><strong>RPM</strong></td>
                <td align="center" ><strong>PLN</strong></td>
                <td align="center" ><strong>TOTAL</strong></td>
            </tr> -->
        </thead>
        <tbody style="font-size:12px" >
            <?php 
                $no =  ( isset( $number ) && ( $number != NULL) )  ? $number : 1 ;
                foreach( $rows as $ind => $row ):
            ?>
            <tr >
                <td> <?php echo $no ++ ?> </td>
                <?php foreach( $header as $key => $value ):?>
                    <?php if( $key == "title" ):?>
                        <td>
                            <a href="<?= site_url(  ) ?>uadmin/activity/detail/<?= $row->id?>">
                                <?= $row->$key?>
                            </a>
                        </td>
                    <?php else : ?>
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
                    <?php endif;?>
                <?php endforeach;?>
            </tr>
            <?php 
                endforeach;
            ?>
        </tbody>
    </table>
</div>