<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <?php $this->load->view('common/header_include'); ?>
    <script type="text/javascript" src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
    <script type="text/javascript" src="https://www.chartjs.org/samples/latest/utils.js"></script>
    <!-- END HEAD -->
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <?php $this->load->view('common/header'); ?>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER --> 
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <?php $this->load->view('common/sidebar'); ?>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Admin Dashboard
<!--                            <small>statistics, charts, recent events and reports</small>-->
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN DASHBOARD STATS 1-->
                        <div class="row">
                        </div>
                        <div class="clearfix"></div>
                        <!-- END DASHBOARD STATS 1-->
                        <div class="row">

                        </div>
                        



                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->
                <!-- END QUICK SIDEBAR -->
            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
<?php $this->load->view('common/footer'); ?>
            <!-- END FOOTER -->
        </div>
        <!-- END QUICK NAV -->
        <!-- BEGIN CORE PLUGINS -->
<?php $this->load->view('common/js_include'); ?>
        <!-- End -->
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var color = Chart.helpers.color;

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [<?php echo implode($line_chart_label, ','); ?>],
                    datasets: [{
                            data: [<?php echo implode($line_chart_data, ','); ?>],

                            backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                            borderColor: window.chartColors.blue,
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    },
                    legend: {
                        display: false,
                    },
                }
            });
        </script>

        <script>
//            var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            var color = Chart.helpers.color;
            var barChartData = {
                labels: [<?php echo implode($bar_chart_label, ','); ?>],
                datasets: [
<?php echo $chartData; ?>
//                    { label: 'Product 1',
//                        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
//                        borderColor: window.chartColors.red,
//                        borderWidth: 1,
//                        data: [
//                            '1000',
//                            '1200',
//                            '600',
//                            '1200',
//                            '1200',
//                            '1200',
//                            '1200',
//                            '1200',
//                            '1200',
//                            '1200',
//                            '1200',
//                            '1200'
//                        ]
//                    }
//                    , 
                ]

            };

            window.onload = function () {
                var ctx = document.getElementById('canvas').getContext('2d');
                window.myBar = new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        responsive: true,
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: ''
                        }
                    }
                });

            };

            document.getElementById('randomizeData').addEventListener('click', function () {
                var zero = Math.random() < 0.2 ? true : false;
                barChartData.datasets.forEach(function (dataset) {
                    dataset.data = dataset.data.map(function () {
                        return zero ? 0.0 : randomScalingFactor();
                    });

                });
                window.myBar.update();
            });

            var colorNames = Object.keys(window.chartColors);
            document.getElementById('addDataset').addEventListener('click', function () {
                var colorName = colorNames[barChartData.datasets.length % colorNames.length];
                var dsColor = window.chartColors[colorName];
                var newDataset = {
                    label: 'Dataset ' + (barChartData.datasets.length + 1),
                    backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                    borderColor: dsColor,
                    borderWidth: 1,
                    data: []
                };

                for (var index = 0; index < barChartData.labels.length; ++index) {
                    newDataset.data.push(randomScalingFactor());
                }

                barChartData.datasets.push(newDataset);
                window.myBar.update();
            });

            document.getElementById('addData').addEventListener('click', function () {
                if (barChartData.datasets.length > 0) {
                    var month = MONTHS[barChartData.labels.length % MONTHS.length];
                    barChartData.labels.push(month);

                    for (var index = 0; index < barChartData.datasets.length; ++index) {
                        // window.myBar.addData(randomScalingFactor(), index);
                        barChartData.datasets[index].data.push(randomScalingFactor());
                    }

                    window.myBar.update();
                }
            });

            document.getElementById('removeDataset').addEventListener('click', function () {
                barChartData.datasets.pop();
                window.myBar.update();
            });

            document.getElementById('removeData').addEventListener('click', function () {
                barChartData.labels.splice(-1, 1); // remove the label first

                barChartData.datasets.forEach(function (dataset) {
                    dataset.data.pop();
                });

                window.myBar.update();
            });
        </script>
    </body>
</html>