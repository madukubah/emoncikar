<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover  ">
        <thead style="font-size:12px" >
        <tr>
            <td ><div align="center"><strong>No</strong></div></td>
            <td ><div align="center"><strong> Paket Pekerjaan</strong></div></td>
            <td ><strong>Tanggal</strong></td>
            <td ><div align="center"><strong>Permasalahan</strong></div></td>
            <td ><div align="center"><strong>Tanggal Masalah</strong></div></td>
            <td ><div align="center"><strong>Upaya yang diperlukan</strong></div></td>
            <td ><div align="center"><strong>Instansi/Pejabat yang Berwenang</strong></div></td>
            <td ><div align="center"><strong>Waktu Penyelesaian</strong></div></td>
            <td ><div align="center"><strong>Dukungan Atasan yang diperlukan</strong></div></td>
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