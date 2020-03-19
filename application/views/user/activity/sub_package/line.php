<?php
    for( $i = count( $data_sets[1]->values ) -1 ; $i >=1 ; $i-- )
    {
      if( $data_sets[1]->values[$i] == $data_sets[1]->values[$i - 1] )
        unset( $data_sets[1]->values[$i] );
      else break;
    }
    unset( $data_sets[1]->values[ count( $data_sets[1]->values ) -1 ] );

    for( $i = count( $data_sets[0]->values ) -1 ; $i >=1 ; $i-- )
    {
      if( $data_sets[0]->values[$i] == $data_sets[0]->values[$i - 1] )
        unset( $data_sets[0]->values[$i] );
      else break;
    }
    unset( $data_sets[0]->values[ count( $data_sets[0]->values ) -1 ] );
?>
<div class="card p-2" style="background-color : rgba(255, 255, 255, 0.6) !important">
    <h5 class="justify-content-center text-center" ><?= $title?></h5>
    <div class="chart">
        <canvas id="<?= $chart_id?>" style="height:250px; min-height:250px"></canvas>
        <!-- <canvas id="visitors-chart" style="height:250px; min-height:250px"></canvas> -->
    </div>
    <br>
    <div class="table-responsive" >
        <table style="font-size:12px" class="table table-striped table-bordered table-hover" >
            <tr>
                <td></td>
                <?php
                    foreach( [ "Januari",'Februari', 'Maret', 'April', 'Mei','Juni', 'Juli',  'Agustus','September', 'Oktober','November','Desember' ] as $month ):
                ?>
                    <td>
                        <?= $month?>
                    </td>
                <?php
                    endforeach;
                ?>
            </tr>
            <tr style="color: red" >
                <td>
                    <?= $data_sets[0]->title  ?>
                </td>
                <?php
                    foreach( $data_sets[0]->table as $value ):
                ?>
                    <td>
                        <?= number_format( $value )?>
                    </td>
                <?php
                    endforeach;
                ?>
            </tr>
            <tr style="color: green" >
                <td>
                    <?= $data_sets[1]->title  ?>
                </td>
                <?php
                    foreach( $data_sets[1]->table as $value ):
                ?>
                    <td>
                        <?= number_format( $value )?>
                    </td>
                <?php
                    endforeach;
                ?>
            </tr>
            <tr>
                <td>
                    Deviasi
                </td>
                <?php
                    foreach( $data_sets[1]->table as $ind => $value ):
                ?>
                    <td>
                        <?= number_format( abs( $value - $data_sets[0]->table[ $ind ] ) )?>
                    </td>
                <?php
                    endforeach;
                ?>
            </tr>
        </table>
    </div>
</div>
<script>
    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }
    var mode      = 'index'
    var intersect = true
    var $visitorsChart = $( '#<?= $chart_id?>' )
    var visitorsChart  = new Chart($visitorsChart, {
        data   : {
        labels  : [ "Januari",'Februari', 'Maret', 'April', 'Mei','Juni', 'Juli',  'Agustus','September', 'Oktober','November','Desember' ],
        datasets: [{
            type                : 'line',
            data                : <?php echo json_encode( $data_sets[0]->values) ?>,
            backgroundColor     : 'transparent',
            borderColor         : <?= $data_sets[0]->color ?> ,
            pointBorderColor    : <?= $data_sets[0]->color ?> ,
            pointBackgroundColor: <?= $data_sets[0]->color ?> ,
            fill                : false
            // pointHoverBackgroundColor: '#007bff',
            // pointHoverBorderColor    : '#007bff'
        },
            {
            type                : 'line',
            data                : <?php echo json_encode( $data_sets[1]->values ) ?>,
            backgroundColor     : 'tansparent',
            borderColor         : <?= $data_sets[1]->color ?> ,
            pointBorderColor    : <?= $data_sets[1]->color ?> ,
            pointBackgroundColor: <?= $data_sets[1]->color ?> ,
            fill                : false
            // pointHoverBackgroundColor: '#ced4da',
            // pointHoverBorderColor    : '#ced4da'
            }]
        },
        options: {
        maintainAspectRatio: false,
        tooltips           : {
            mode     : mode,
            intersect: intersect
        },
        hover              : {
            mode     : mode,
            intersect: intersect
        },
        legend             : {
            display: false
        },
        scales             : {
            yAxes: [{
            // display: false,
            gridLines: {
                display      : true,
                lineWidth    : '4px',
                color        : 'rgba(0, 0, 0, .2)',
                zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
                beginAtZero : true,
                suggestedMax: 100
            }, ticksStyle)
            }],
            xAxes: [{
            display  : true,
            gridLines: {
                display: false
            },
            ticks    : ticksStyle
            }]
        }
        }
    })
</script>