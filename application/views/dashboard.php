<!DOCTYPE html>
<html>
<?=$header?>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?=$top_navbar?>
  <?=$sidebar_menu?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Overview</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-sm-3">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?=$total_customers['customers']?></h3>
            <p>Total Customers</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="/customers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?=$total_products['products']?></h3>
            <p>Total Products</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="javascript:" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>    
      </div>
      <div class="col-sm-3">
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?=$total_sale?></h3>
            <p>Total Sales Record</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="javascript:" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>    
      </div>
      <div class="col-sm-3">
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?=$total_stores['stores']?></h3>
            <p>Total Stores</p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-cart"></i>
          </div>
          <a href="javascript:" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>    
      </div>
    </div>
      <!-- solid sales graph -->
      <div class="box box-solid bg-teal-gradient">
        <div class="box-header">
          <i class="fa fa-th"></i>
          <h3 class="box-title">Sales Graph</h3>
          <div class="box-tools pull-right">
            <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body border-radius-none">
          <div class="chart" id="line-chart" style="height: 350px;"></div>
        </div><!-- /.box-body -->
        <div class="box-footer no-border">
          <p style="color:#000;margin-bottom: 0">Quarter Sales record for year 1997 and 1998</p>
        </div><!-- /.box-footer -->
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <?=$page_footer?>

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
            <a href="javascript::;">
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
<input type="hidden" name="quarter_sale" value='<?=$quarter_sale?>'>
<?=$footer?>
<script src="/assets/js/home.js"></script>
<script>
 $.widget.bridge('uibutton', $.ui.button);
</script>
</body>
</html>