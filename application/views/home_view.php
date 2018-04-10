<?php $this->load->View("header"); ?>
                <div class="span9" id="content">
                    <div class="row-fluid">
                        <?php 
                          if($this->session->flashdata("notif")){ ?>
                            <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <h4>Welcome <?php $datauser=$this->session->flashdata("notif");echo $datauser; ?></h4>
                              To Koperasi Red Top
                            </div>
                        <?php  } ?>
                    </div>
                </div>
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- <button id="test">Test</button> -->
          <div class="row">
                 <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua" data-target="data_1">
                <div class="inner">
                  <h4><?php echo currency_format($profit_by_year_inventory['untung_by_order']); ?></h4>
                  <p>TOTAL PROFIT INV</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green" data-target="data_2">
                <div class="inner">
                  <h4><?php echo currency_format($profit_by_year_koperasi['untung_by_order']); ?></h4>
                  <p>TOTAL PROFIT KOPERASI</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow" data-target="data_3">
                <div class="inner">
                  <h4><?php echo count($count_anggota) ?></h4>
                  <p>ANGGOTA KOPERASI</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red" data-target="data_4">
                <div class="inner">
                  <h4><?php echo currency_format($asset_by_harga_jual) ?></h4>                 
                  <p>VALUE INVENTORY HARGA JUAL</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red" data-target="data_4">
                <div class="inner">
                  <h4><?php echo currency_format($asset_by_harga_beli) ?></h4>                 
                  <p>VALUE INVENTORY HARGA BELI</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

          </div><!-- /.row -->
          <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Summary Sales Order</h3> / 
                                                      <span style="background-color:#D2D6DE">Transaksi Pembelian : <?php  echo currency_format($sum_transaksi_beli); ?></span> / 
                                                      <span style="background-color:#00A65A">Transaksi Penjualan : <?php  echo currency_format($sum_transaksi_jual); ?></span>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="barChart" style="height:230px"></canvas>
                  </div>
                </div><!-- /.box-body -->
          </div><!-- /.box -->
          <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Summary Profit</h3> / 
                                                      <span style="background-color:#D2D6DE">Transaksi Inventory : <?php  echo currency_format($sum_profit_inventory); ?></span> / 
                                                      <span style="background-color:#00A65A">Transaksi Koperasi : <?php  echo currency_format($sum_profit_koperasi); ?></span>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="chartKeuntunganInv" style="height:230px"></canvas>
                  </div>
                </div><!-- /.box-body -->
          </div><!-- /.box -->
      <div class="data" id="data_1">
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NO ANGGOTA</th>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>DEPARTMENT</th>
                        <th>JABATAN</th>
                        <th>ALAMAT</th>
                        <th>NO TELPON</th>
                        <th>NO REKENING</th>
                        <th>CREATED TIME</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                  </tbody>
            <tfoot>                  
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
</div>
<div class="data" id="data_2">
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features2</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NO ANGGOTA</th>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>DEPARTMENT</th>
                        <th>JABATAN</th>
                        <th>ALAMAT</th>
                        <th>NO TELPON</th>
                        <th>NO REKENING</th>
                        <th>CREATED TIME</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                  </tbody>
            <tfoot>                  
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
</div>
<div class="data" id="data_3">
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features3</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NO ANGGOTA</th>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>DEPARTMENT</th>
                        <th>JABATAN</th>
                        <th>ALAMAT</th>
                        <th>NO TELPON</th>
                        <th>NO REKENING</th>
                        <th>CREATED TIME</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                  </tbody>
            <tfoot>                  
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
</div>
<div class="data" id="data_4">
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features4</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NO ANGGOTA</th>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>DEPARTMENT</th>
                        <th>JABATAN</th>
                        <th>ALAMAT</th>
                        <th>NO TELPON</th>
                        <th>NO REKENING</th>
                        <th>CREATED TIME</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                  </tbody>
            <tfoot>                  
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
</div>
</section>
<?php $this->load->View("footer"); ?>
<script type="text/javascript" src="<?php echo base_url() ?>asset/my_js/home.js"></script>
<style type="text/css">
  .data{
    display: none;
  }
</style>
<script type="text/javascript">
  $('#test').click(function() {
    $.confirm({
        text: "This is a confirmation dialog manually triggered! Please confirm:",
        confirm: function(button) {
            alert("You just confirmed.");
        },
        cancel: function(button) {
            alert("You cancelled.");
        }
    });
});
</script>
<script type="text/javascript">
  $(function(){
       var chartData = <?php echo json_encode($summary) ?>;
       console.log(chartData);
       var pembelianValue = [];
       var penjualanValue = [];
       var label = [];
       for (var i = 0; i < chartData.length; i++) {
          label.push(chartData[i].bulan);
          pembelianValue.push(chartData[i].total_beli);
          penjualanValue.push(chartData[i].total_jual);
       };
       console.log(label);
       var areaChartData = {
            labels: label,
            datasets: [
              {
                label: "Electronics",
                fillColor: "rgba(210, 214, 222, 1)",
                strokeColor: "rgba(210, 214, 222, 1)",
                pointColor: "rgba(210, 214, 222, 1)",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: pembelianValue
              },
              {
                label: "Digital Goods",
                fillColor: "rgba(60,141,188,0.9)",
                strokeColor: "rgba(60,141,188,0.8)",
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: penjualanValue
              }
            ]
          };
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };
barChart.Bar(areaChartData, barChartOptions);
  });
  $(function(){
       var dataProfit = <?php echo json_encode($summary_profit_by_month) ?>;
       console.log(dataProfit);
       var pembelianValue = [];
       var penjualanValue = [];
       var label = [];
       for (var i = 0; i < dataProfit.length; i++) {
          label.push(dataProfit[i].bulan);
          pembelianValue.push(dataProfit[i].profit_inventory);
          penjualanValue.push(dataProfit[i].profit_koperasi);
       };
       console.log(label);
       var areadataProfit = {
            labels: label,
            datasets: [
              {
                label: "Electronics",
                fillColor: "rgba(210, 214, 222, 1)",
                strokeColor: "rgba(210, 214, 222, 1)",
                pointColor: "rgba(210, 214, 222, 1)",
                pointStrokeColor: "#c1c7d1",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: pembelianValue
              },
              {
                label: "Digital Goods",
                fillColor: "rgba(60,141,188,0.9)",
                strokeColor: "rgba(60,141,188,0.8)",
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: penjualanValue
              }
            ]
          };
        var barChartCanvas = $("#chartKeuntunganInv").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var bardataProfit = areadataProfit;
        bardataProfit.datasets[1].fillColor = "#00a65a";
        bardataProfit.datasets[1].strokeColor = "#00a65a";
        bardataProfit.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };
barChart.Bar(areadataProfit, barChartOptions);
  });
</script>

