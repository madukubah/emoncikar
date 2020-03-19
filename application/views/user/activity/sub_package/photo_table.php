<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover  ">
        <thead style="font-size:12px" >
            <tr>
                <td rowspan="2" align="center" ><strong>No</strong></td>
                <td rowspan="2" align="center" ><strong>Kode</strong></td>
                <td rowspan="2" align="center" width="30%" ><strong>Paket Pekerjaan</strong></td>
                <td colspan="2" align="center" width="20%"  ><strong>Koordinat</strong></td>
                <td colspan="5" align="center" ><strong>Foto</strong></td>
                <!-- <td rowspan="2" align="center" ><strong>Keterangan</strong></td> -->
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
                <td> <?php echo $row->code ?> </td>
                <td> <?php echo $row->title ?> </td>
                <td> <?php echo $row->longitude ?> </td>
                <td> <?php echo $row->latitude ?> </td>
                <?php 
                    $images = explode(";", $row->images);
                    foreach( $images as $i => $image ):
                ?>
                    <td>
                        <a href="" data-toggle="modal" data-target="#image<?php echo  $row->id . $i; ?>">
                            <img class=" img-fluid" src="<?php echo $image_url.$image  ?>" alt="" height="auto" width="500">
                        </a>
                        <div class="modal fade" id="image<?php echo  $row->id . $i; ?>" role="dialog">
                            <div class="modal-dialog modal-xl " style="overflow: hidden">
                                <img class=" img-fluid" src="<?php echo $image_url.$image  ?>" alt="" height="auto" width="1500">
                            </div>
                        </div>
                    </td>
                <?php endforeach;?>
            </tr>
            <?php 
                endforeach;
            ?>
        </tbody>
    </table>
</div>