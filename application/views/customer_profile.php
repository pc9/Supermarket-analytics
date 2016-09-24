<!DOCTYPE html>
<html>
<?=$header?>
<style type="text/css">
.box-primary hr{
  margin:5px 0;
}
</style>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?=$top_navbar?>
  <?=$sidebar_menu?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Customer Profile</h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customer Profile</li>
      </ol>
    </section>  
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="/assets/img/user.png" alt="User profile picture">
                  <h3 class="profile-username text-center"><?=$user['fullname']?></h3>
                  <p class="text-muted text-center"><?=$user['occupation']?> <small>(occupation)</small></p>
                  <hr>
                  <strong>Education</strong>
                  <p class="text-muted"><?=$user['education']?></p>
                  <hr>
                  <strong>Phone</strong>
                  <p class="text-muted"><?=$user['phone1']?></p>
                  <hr>
                  <strong>Address</strong>
                  <p class="text-muted"><?=$user['address1'].', '.$user['city'].', '.$user['state_province'].', '.$user['country'].' '.$user['postal_code']?></p>
                  <hr>
                  <strong>Birthdate</strong>
                  <p class="text-muted"><?php $date = new DateTime($user['birthdate']); echo $date->format('d-m-Y') ?></p>
                  <hr>
                  <strong>Member Card</strong>
                  <p class="text-muted"><?=$user['member_card']?></p>
                  <hr>
                  <p><strong>Gender : </strong><?=$user['gender']?>, <strong>Marital Status : </strong><?=$user['marital_status']?></p>
                </div>
              </div>

            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <div class="tab-content">
                  <div class="active tab-pane">
                    <h4>Sales Graph</h4>
                    <p>Expenditure graph of user for the year 
                      <select class="form-control" style="height:auto;padding:0;width:60px;display: inline-block" name="the_year">
                        <option value="1997">1997</option>
                        <option value="1998">1998</option>
                      </select>
                    </p>
                    <div class="chart">
                      <canvas id="barChart" style="height:300px"></canvas>
                    </div>
                    <h4>Frequency of visit</h4>
                    <p>No of visits by user for year 
                      <select class="form-control" style="height:auto;padding:0;width:60px;display: inline-block" name="year">
                        <option value="1997">1997</option>
                        <option value="1998">1998</option>
                      </select>
                    </p>
                    <div class="chart">
                      <canvas id="barVisitChart" style="height:300px"></canvas>
                    </div>
                  </div>
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
</div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul><!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul><!-- /.control-sidebar-menu -->

      </div><!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>
          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>
            <p>
              Some information about this general settings option
            </p>
          </div><!-- /.form-group -->
        </form>
      </div><!-- /.tab-pane -->
    </div>
  </aside><!-- /.control-sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<input type="hidden" name="sales_data" value='<?=$sales_data?>'>
<input type="hidden" name="visit_data" value='<?=$visit_data?>'>
<?=$footer?>
<script src="/assets/js/jquery-jvectormap-north_america-mill.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
  createChart();
  $(document).on('change','select[name="the_year"]',createChart);
  $(document).on('change','select[name="year"]',frequencyChart);
  function createChart()
  {
    var data = JSON.parse($('input[name="sales_data"]').val());
    var the_year = $('select[name="the_year"]').val();
    var areaChartData = {
      labels: data[the_year].month,
      datasets: [
        {
          label: "Sales",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: data[the_year].sales
        },
        {
          label: "Profit",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: data[the_year].profit
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

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  }
  frequencyChart();
  function frequencyChart()
  {
    var data = JSON.parse($('input[name="visit_data"]').val());
    var year = $('select[name="year"]').val();
    var areaChartData = {
      labels: data[year].month,
      datasets: [
        {
          label: "Frequency",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: data[year].frequency
        },        
      ]
    };
    var barChartCanvas = $("#barVisitChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[0].fillColor = "#00a65a";
    barChartData.datasets[0].strokeColor = "#00a65a";
    barChartData.datasets[0].pointColor = "#00a65a";
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

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  }  
</script>
</body>
</html>