            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $title; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add, View, Edit, Delete usage
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div id="piechart"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Activity for past week
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="bargraph"></div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
Morris.Donut({
  element: 'piechart',
  data: [
<?php foreach ($log as $log_item): ?>      
    {label: "<?php echo $log_item['action']; ?>", value: <?php echo $log_item['total']; ?>}<?php if ($log_item != end($log)) echo ","; ?>
<?php endforeach; ?>
  ]
});

Morris.Bar({
  element: 'bargraph',
  data: [
<?php foreach ($dailylog as $daily_item): ?>      
    { y: '<?php echo $daily_item['Date']; ?>', a: <?php echo $daily_item['totalCount']; ?> }<?php if ($daily_item != end($dailylog)) echo ","; ?>
<?php endforeach; ?>
  ],
   xkey: 'y',
  ykeys: ['a'],
  labels: ['Series A']
});</script>