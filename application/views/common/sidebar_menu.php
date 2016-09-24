<aside class="main-sidebar">

 <!-- sidebar: style can be found in sidebar.less -->
 <section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
   <div class="pull-left image">
    <img src="/assets/img/user.png" class="img-circle" alt="User Image">
  </div>
  <div class="pull-left info">
    <p>Administrator</p>
    <!-- Status -->
    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
  </div>
</div>

<!-- Sidebar Menu -->
<ul class="sidebar-menu">
 <li class="header">MENU</li>
 <!-- Optionally, you can add icons to the links -->
 <li <?php echo ($active == 'dashboard')?'class="active"':''; ?> ><a href="/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
 <li <?php echo ($active == 'customers_summ' || $active == 'valuable_customers')?'class="active treeview"':'class="treeview"'; ?> >
  <a href="javascript:">
    <i class="ion ion-person"></i> <span>Customers</span> <i class="fa fa-angle-left pull-right"></i>
  </a>
  <ul class="treeview-menu">
    <li <?php echo ($active == 'customers_summ')?'class="active"':''; ?> ><a href="/customers/summarization"><i class="fa fa-circle-o"></i> Summarization</a></li>
    <li <?php echo ($active == 'valuable_customers')?'class="active"':''; ?> ><a href="/customers"><i class="fa fa-circle-o"></i> Valuable customers</a></li>
    <li <?php echo ($active == 'customer_trend')?'class="active"':''; ?> ><a href="/customers/trend"><i class="fa fa-circle-o"></i> Customers Trend</a></li>        
  </ul>
  </li>
 <li <?php echo ($active == 'sales')?'class="active"':''; ?> ><a href="/sales"><i class="ion ion-stats-bars"></i> <span>Sales</span></a></li>
 <li <?php echo ($active == 'inventory')?'class="active"':''; ?> ><a href="/inventory"><i class="ion ion-bag"></i> <span>Inventory</span></a></li>
<!--  <li <?php echo ($active == 'stores')?'class="active"':''; ?> ><a href="javascript:"><i class="ion ion-ios-cart"></i> <span>Stores</span></a></li> -->
</ul><!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>