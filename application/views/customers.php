<!DOCTYPE html>
<html>
<?=$header?>
<style type="text/css">
  .content-body{
    background-color: #fff;
    padding:10px 15px;
    margin-top:10px;
  }
  .content-body .box{
    border-top:none;
  }
</style>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
  <?=$top_navbar?>
  <?=$sidebar_menu?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Valuable Customers</h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customers</li>
      </ol>
    </section>  
    <div class="container-fluid">
      <div class="content-body">
        <p>Valuable customers are judged based on the following : </p>
        <form method="POST" onsubmit="getData();return false;">
          <div class="row">
            <div class="col-sm-2">
              <div class="form-group">
                <label>Deciding Parameter</label>
                <select class="form-control" name="deciding_param">
                  <option value="frequency_of_visit">Frequency of visit</option>
                  <option value="profit">Profit to store</option>
                  <option value="both">Both</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label>Frequency of visit</label>
                <input name="frequency_of_visit_value" class="form-control" type="number" step="1" min="0" placeholder="visit count" disabled>
              </div>
            </div> 
            <div class="col-sm-2">
              <div class="form-group">
                <label>Profit to store</label>
                <input name="profit_value" class="form-control" type="number" step="1" min="0" placeholder="profit value" disabled>
              </div>
            </div> 
            <div class="col-sm-2">
              <div class="form-group">
                <label>Year</label>
                <select class="form-control" name="year">
                  <option>1997</option>
                  <option>1998</option>
                </select>
              </div>
            </div> 
            <div class="col-sm-2">
              <div class="form-group">
                <label>Month</label>
                <select class="form-control" name="month">
                  <option>January</option>
                  <option>February</option>
                  <option>March</option>
                  <option>April</option>
                  <option>May</option>
                  <option>June</option>
                  <option>July</option>
                  <option>August</option>
                  <option>September</option>
                  <option>October</option>
                  <option>November</option>
                  <option>December</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <button class="btn btn-primary" style="margin-top:25px" type="submit">Get Data</button>
              </div>
            </div>                                                             
          </div>
        </form>
        <div class="box">
          <table id="customers_data" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Frequency</th>
                <th>Profit</th>
              </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
              <th>Name</th>
              <th>Frequency</th>
              <th>Profit</th>            
            </tfoot>
          </table>        
          <div class="overlay hidden">
            <i class="fa fa-refresh fa-spin"></i>
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
<?=$footer?>
<script src="/assets/js/jquery-jvectormap-north_america-mill.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
  function setParams()
  {
    var val = $('select[name="deciding_param').val();
    if(val == 'frequency_of_visit')
    {
      $('input[name="frequency_of_visit_value"]').attr('disabled',false);
      $('input[name="profit_value"]').attr('disabled',true);
    }
    if(val == 'profit')
    {
      $('input[name="frequency_of_visit_value"]').attr('disabled',true);
      $('input[name="profit_value"]').attr('disabled',false);
    }  
    if(val == 'both')
    {
      $('input[name="frequency_of_visit_value"]').attr('disabled',false);
      $('input[name="profit_value"]').attr('disabled',false);
    }    
  }
  // $('#customers_data').DataTable({"bDestroy": true});
  $(document).on('change','select[name="deciding_param"]',setParams);
  setParams();
  function getData()
  {
    var obj = {
      'deciding_param' : $('select[name="deciding_param').val(),
      'frequency_of_visit_value' : $('input[name="frequency_of_visit_value"]').val(),
      'profit_value' : $('input[name="profit_value"]').val(),
      'year' : $('select[name="year').val(),
      'month' : $('select[name="month').val()
    }
    $('.content-body .overlay').removeClass('hidden');
    $.get('/customers/valuable_customers?'+$.param(obj),function(data){
      var heading='<tr><th>Name</th>';
      var tbody='';
      if(data !='[]'){
        data = JSON.parse(data);
        heading+=(data[0].count != undefined)?'<th>Frequency</th>':'';
        heading+=(data[0].profit != undefined)?'<th>Profit</th>':'';
        heading+='</tr>';
        $.each(data,function(index,value){
          tbody+='<tr>';
          tbody+='<td><a href="/customers/view/'+value.customer_id+'">'+value.fullname+'</a></td>';
          tbody+=(value.count != undefined)?'<td>'+value.count+'</td>':'';
          tbody+=(value.profit != undefined)?'<td>'+value.profit+'</td>':'';
          tbody+='</tr>';
        });
      }
      var tables = $.fn.dataTable.fnTables(true);
      $(tables).each(function () {
        $(this).dataTable().fnClearTable();
        $(this).dataTable().fnDestroy();
      });
      $('#customers_data thead').html(heading);
      $('#customers_data tfoot').html(heading);
      $('#customers_data tbody').html(tbody);
      $('#customers_data').DataTable();
      $('.content-body .overlay').addClass('hidden');
    });
  }
  getData();
</script>
</body>
</html>