<!DOCTYPE html>
<html>
<?=$header?>
<style type="text/css">
  .box{
    margin:10px 0;
  }
  circle {
    fill: rgb(31, 119, 180);
    fill-opacity: .25;
    stroke: rgb(31, 119, 180);
    stroke-width: 1px;
  }
  .leaf circle {
    fill: #ff7f0e;
    fill-opacity: 1;
  }
  text{
    font: 10px sans-serif;
  }  
</style>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?=$top_navbar?>
  <?=$sidebar_menu?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Customers ( <?=$total_count['total']?> ) <small><a href="javascript:"><small class="label bg-green">View all</small></a></small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customers Summarization</li>
      </ol>
    </section>  
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-usd"></i>
              <h3 class="box-title">Show Customers distribution</h3>
              <form class="form-inline" style="display: inline-block;">
                <div class="form-group">
                  <label>based on</label>
                  <select class="form-control" style="height:auto;padding:0" name="customer_count_group">
                    <option value="salary">Salary</option>
                    <option value="state">State Province</option>
                    <option value="member_card">Member Card</option>
                    <option value="education">Education</option>
                    <option value="occupation">Occupation</option>
                    <option value="age">Age</option>
                    <option value="marital_status">Marital Status</option>
                  </select>
                </div>
              </form>              
              
            </div>
            <div class="box-body">
              <div id="bar-chart" style="height: 450px;"></div>
            </div>
          </div>          
        </div>
      </div>  
      <div class="row">
        <div class="col-sm-4">
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-user"></i>
              <h3 class="box-title">Customers ( Male and Female )</h3>
            </div>
            <div class="box-body">
              <div id="donut-chart" style="height: 450px;"></div>
            </div>
          </div> 
        </div>      
        <div class="col-sm-8">        
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">
                Customers
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 450px; width: 100%;"></div>
            </div>
          </div>        
        </div>
        <div class="col-sm-12">
          <div class="box box-primary">
            <div class="box-header">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">
                Customers city wise distribution
              </h3>
            </div>
            <div class="box-body city_wise_distribution">
              
            </div>
          </div>           
        </div>
      </div>  
    </div>
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
<input type="hidden" name="customers_count_by_gender" value='<?=$customers_count_by_gender?>'>
<input type="hidden" name="customers_count_by_income" value='<?=$customers_count_by_income?>'>
<input type="hidden" name="customers_count_by_age" value='<?=$customers_count_by_age?>'>
<input type="hidden" name="customers_count_by_marital_status" value='<?=$customers_count_by_marital_status?>'>
<input type="hidden" name="customers_count_by_occupation" value='<?=$customers_count_by_occupation?>'>
<input type="hidden" name="customers_count_by_member_card" value='<?=$customers_count_by_member_card?>'>
<input type="hidden" name="customers_count_by_education" value='<?=$customers_count_by_education?>'>
<input type="hidden" name="customers_count_by_country" value='<?=$customers_count_by_country?>'>
<input type="hidden" name="customers_count_by_state" value='<?=$customers_count_by_state?>'>
<input type="hidden" name="customers_count_by_city" value='<?=$customers_count_by_city?>'>
<?=$footer?>
<script src="/assets/js/jquery-jvectormap-north_america-mill.js"></script>
<script src="/assets/js/customers.js"></script>
<script>
 $.widget.bridge('uibutton', $.ui.button);
</script>
</body>
</html>