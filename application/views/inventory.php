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
      <h1>Inventory</h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory</li>
      </ol>
    </section>  
    <div class="container-fluid">
      <div class="content-body">
        <p>Products judgement for its inventory is done on the basis of Number of units ordered and Number of units shipped from warehouse.</p>
        <p>If Units orderded greater than Units shipped then its stock in warehouse is to be increased else reduce that stock in warehouse</p>
        <form method="POST" onsubmit="getData();return false;">
          <div class="row">
            <div class="col-sm-2">
              <div class="form-group">
                <label>Store</label>
                <select class="form-control" name="store">
                  <?php 
                    foreach ($store as $key => $value) {?>
                      <option value="<?=$value['store_id']?>"><?=$value['store_name']?></option>  
                  <?php }?>
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
          <table id="products_data" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Product Name</th>
                <th>Units Ordered</th>
                <th>Units Sold</th>
                <th>Evaluation</th>
              </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <th>Product Name</th>
                <th>Units Ordered</th>
                <th>Units Sold</th>
                <th>Evaluation</th>          
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
  function getData()
  {
    var obj = {
      'store_id' : $('select[name="store').val()
    }
    $('.content-body .overlay').removeClass('hidden');
    $.get('/inventory/get_inventory_data?'+$.param(obj),function(data){
      var tbody='';
      if(data !='[]'){
        data = JSON.parse(data);
        $.each(data,function(index,value){
            var action = 'Increase';
          if(value.diff>0)
            action = 'Decrease';
          tbody+='<tr>';
          tbody+='<td>'+value.product_name+'</td>';
          tbody+='<td>'+value.ordered+'</td>';
          tbody+='<td>'+value.shipped+'</td>';
          tbody+='<td>'+action+'</td>';
          tbody+='</tr>';
        });
      }
      var tables = $.fn.dataTable.fnTables(true);
      $(tables).each(function () {
        $(this).dataTable().fnClearTable();
        $(this).dataTable().fnDestroy();
      });
      $('#products_data tbody').html(tbody);
      $('#products_data').DataTable();
      $('.content-body .overlay').addClass('hidden');
    });
  }
  getData();
</script>
</body>
</html>