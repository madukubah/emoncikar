<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover  ">
        <thead style="font-size:12px" >
            <tr>
                <td rowspan="2" align="center" ><strong>No</strong></td>
                <td rowspan="2" align="center" ><strong>Kode</strong></td>
                <td rowspan="2" align="center" width="20%"><strong>Nama Satuan Kerja </strong></td>
                <td colspan="3" align="center" ><strong>Pagu (Rp Ribu) <br>
                </strong></td>
                <td colspan="2" align="center" ><strong>Realisasi SP2D</strong></td>
                <td colspan="2" align="center" ><strong>Realisasi SPM </strong></td>
                <td rowspan="2" align="center" ><strong>Progres<br>
            Fisik (%)</strong></td>
                <td rowspan="2" align="center" ><strong>Tanggal<br>
                    Kirim</strong></td>
            </tr>
            <tr>
                <td align="center" width="11%" ><strong>Pagu SPAN </strong></td>
                <td align="center" width="11%" ><strong>eMonitoring
                    (Akun)
                </strong></td>

                <td align="center" width="11%" ><strong>Paket
                    (Pengadaan)
                </strong></td>
                <td align="center" width="11%" >(<strong>Rp Ribu</strong>)</td>
                <td align="center" ><strong>%</strong></td>
                <td align="center" width="11%" >(<strong>Rp Ribu</strong>)</td>
                <td align="center" ><strong>%</strong></td>
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
                    <?php if( $key == "name" ):?>
                        <td>
                            <a href="<?= site_url(  ) ?>uadmin/activity/detail/<?= $row->id?>">
                                <?= $row->$key?>
                            </a>
                        </td>
                    <?php else : ?>
                        <td  >
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