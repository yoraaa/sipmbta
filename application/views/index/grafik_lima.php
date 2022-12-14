<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo !empty($title) ? $title : null ?></h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="pendapatan"></div>
        </div>
    </div>
</main>
<script>
    
   Highcharts.chart('pendapatan', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'center',
        text: 'Grafik Berdasarkan Total Pendapatan Per Bank'
    },
    subtitle: {
        align: 'center',
        text: 'Total Pendapatan RP <?= $total_pendapatan ?>'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total Pendapatan'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>RP {point.y}</b>'
    },

    series: [
        {
            name: "Pendapatan",
            colorByPoint: true,
            data: <?= $grafik5 ?>
        }
    ],
   
        
    
});
</script>