<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo !empty($title) ? $title : null ?></h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="bayar"></div>
        </div>
    </div>
</main>
<script>
    Highcharts.chart('bayar', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Berdasarkan Total Pendaftar Berdasarkan Bank dan Status Pembayaran'
    },
    subtitle: {
        text: 'Total Pendaftar : <?= $pendaftar ?>'
    },
    xAxis: {
        categories: <?= $bank ?>,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Pendaftar'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} Orang</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: <?= $status ?>
});
</script>