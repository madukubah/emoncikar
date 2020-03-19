<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table>
    <tr>
        <td style="text-align:center;font-size: 14px;font-weight: bold ">Laporan Kegiatan</td>
    </tr>
    
</table>
<br>
<br>
<?php
    $AuFnF_select = [
        "AU" => "[AU] Administrasi Umum",
        "F" => "[F] Fisik",
        "NF" => "[NF] Non Fisik",
      ];
?>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table   >
    <tr style="font-size:12px; border-bottom:0.5px solid black " >
        <td style="width:4% ">1.</td>
        <td style="width:30% ">Uraian</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $activity->title?></td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">2.</td>
        <td style="width:30% ">Tipe Kegiatan</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $AuFnF_select[ $activity->AuFnF ]?> </td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">3.</td>
        <td style="width:30% ">Nomenkaltur</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $nomenclatures_select[ $activity->nomenclature_id ]?> </td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">4.</td>
        <td style="width:30% ">Volume/Kuantitas</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $activity->quantity?> </td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">5.</td>
        <td style="width:30% ">Satuan</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $activity->unit?> </td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">6.</td>
        <td style="width:30% ">Tahun Anggaran</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $activity->year?> </td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">7.</td>
        <td style="width:30% ">APBD Provinsi <br>(dalam ribuan Rp 1.000)</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "> Rp. <?= number_format( $activity->ceiling_budget )?> </td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">8.</td>
        <td style="width:30% ">Lokasi</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $activity->location?> </td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">9.</td>
        <td style="width:30% ">Koordinat (Lat, Long)</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $activity->latitude.','.$activity->longitude ?> </td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">10.</td>
        <td style="width:30% ">PPTK</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $pptk_select[ $activity->pptk_id ] ?> </td>
    </tr>
</table>
<p style="font-size:12px;text-align: center" >
    Foto progress
</p>
<?php
    $images = explode(";", $activity->images);
?>
<table>
      <tr>
        <?php 
            $curl_handle=curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, base_url()."uploads/progress/default.jpg" );
            //curl_setopt($curl_handle, CURLOPT_URL, "./uploads/house/".$images[0] );
            curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
            $default_image = base64_encode( curl_exec($curl_handle) );
            curl_close($curl_handle);
            $title = ["0%", "25%", "50%", "75%", "100%" ];

            foreach( $images as $ind => $image ):
        ?>
            <td>
                <?= $title[ $ind ] ?>
                <br>
                <?php if( $image != 'default.jpg' ): ?>
                    <img src="<?= $image_url.$image ?>" alt="">
                <?php else : ?>
                    <img src="data:image/gif;base64,<?= $default_image ?>" alt="">
                <?php endif; ?>
            </td>
        <?php endforeach;?>
      </tr>
</table>
<p style="font-size:12px;text-align: center" >
    Permasalahan
</p>
<?php foreach( $problems as $ind => $problem ): ?>
<table   >
    <tr style="font-size:12px; border-bottom:0.5px solid black " >
        <td style="width:4% ">1.</td>
        <td style="width:30% ">Tanggal Laporan</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $problem->report_date?></td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">2.</td>
        <td style="width:30% ">Permasalahan</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $problem->problem_description?> </td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">3.</td>
        <td style="width:30% ">Tanggal Masalah</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $problem->problem_date?> </td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">4.</td>
        <td style="width:30% ">Upaya yang diperlukan</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $problem->solution?> </td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">5.</td>
        <td style="width:30% ">Instansi/Pejabat yang Berwenang	</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $problem->authorities ?> </td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">6.</td>
        <td style="width:30% ">Waktu Penyelesaian</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $problem->settlement_date?> </td>
    </tr>
    <tr style="font-size:12px;border-bottom:0.5px solid black" >
        <td style="width:4% ">7.</td>
        <td style="width:30% ">Dukungan Atasan  <br>yang diperlukan</td>
        <td style="width:5% "> :</td>
        <td style="width:50% "><?= $problem->required_support?> </td>
    </tr>
</table>
<?php endforeach;?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->