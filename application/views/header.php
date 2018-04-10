<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi Koperasi</title>
    <link rel="icon" type="image/jpg" href="<?php echo base_url() ?>asset/koperasi_template/logo.jpg">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>asset/koperasi_template/sweet-alert/sweetalert.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url()."asset/koperasi_template/bootstrap/css/font-awesome.min.css" ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url()."asset/koperasi_template/bootstrap/css/ionicons.min.css" ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url() ?>plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url() ?>plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url() ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>asset/styles.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>plugins/select2/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>plugins/datatables/dataTables.bootstrap.css">
    <script src="<?php echo base_url()?>asset/koperasi_template/sweet-alert/sweetalert.min.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/skins/_all-skins.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <link href="<?php echo base_url() ?>asset/jquery-ui-1.9.1.custom.min.css" rel="stylesheet" media="screen">
    <!-- Animated -->
    <link rel="stylesheet" href="<?php echo base_url() ?>asset/animate.css">
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

<header class="main-header">
  <a href="home" class="logo">
    <!-- <img src="<?php echo base_url() ?>asset/koperasi_template/logo.jpg" width="10%"> -->
    Koperasi Red Top
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
   <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
       
        <!-- Notifications: style can be found in dropdown.less -->

        <!-- Tasks: style can be found in dropdown.less -->
    
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url()?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php $datauser=$this->session->userdata("username");echo $datauser[0]['nama']; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo base_url()?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
              <p>
                <?php $datauser=$this->session->userdata("username");echo $datauser[0]['nama']; ?>
                <small>Koperasi Red Top Hotel</small>
              </p>
            </li>
            <!-- Menu Body -->
           <!--  <li class="user-body">
              <div class="col-xs-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
              </div>
            </li> -->
            <!-- Menu Footer-->
            <li class="user-footer">
             <!--  <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div> -->
              <div class="pull-right">
                <a href="<?php echo base_url() ?>login/logoutUser" class="btn btn-default fa-sign-out">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
 <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
           <!--  <div class="pull-left image">
              <img src="<?php echo base_url()?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div> -->
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"><?php echo $this->uri->segment(1) ?></li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $this->uri->segment(1)=="master_anggota"?"active":"" ?>"><a href="<?php echo base_url() ?>master_anggota"><i class="fa  fa-user-plus"></i> Master Anggota</a></li>
                <li class="<?php echo $this->uri->segment(1)=="master_barang"?"active":"" ?>"><a href="<?php echo base_url() ?>master_barang"><i class="fa  fa-cubes"></i> Master Barang</a></li>
                <li class="<?php echo $this->uri->segment(1)=="master_departemen"?"active":"" ?>"><a href="<?php echo base_url() ?>master_departemen"><i class="fa  fa-users"></i> Master Departemen</a></li>
                <li class="<?php echo $this->uri->segment(1)=="master_jabatan"?"active":"" ?>"><a href="<?php echo base_url() ?>master_jabatan"><i class="fa fa-user"></i> Master Jabatan</a></li>
                <li class="<?php echo $this->uri->segment(1)=="master_supplier"?"active":"" ?>"><a href="<?php echo base_url() ?>master_supplier"><i class="fa fa-circle-o"></i> Master Supplier</a></li>
                <li class="<?php echo $this->uri->segment(1)=="master_user"?"active":"" ?>"><a href="<?php echo base_url() ?>master_user"><i class="fa fa-registered"></i> Master User</a></li>

              </ul>
            </li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Transaksi</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $this->uri->segment(1)=="transaksi_pembelian"?"active":"" ?>"><a href="<?php echo base_url() ?>transaksi_pembelian"><i class="fa fa-shopping-cart"></i> Pemesanan Barang</a></li>
                <li class="<?php echo $this->uri->segment(1)=="approval_po"?"active":"" ?>"><a href="<?php echo base_url() ?>approval_po"><i class="fa fa-cart-plus"></i> Form Approve PO</a></li>
                <li class="<?php echo $this->uri->segment(1)=="penerimaan_barang"?"active":"" ?>"><a href="<?php echo base_url() ?>penerimaan_barang"><i class="fa fa-ship"></i> Transaksi Penerimaan Barang</a></li>
                <li class="<?php echo $this->uri->segment(1)=="transaksi_penjualan"?"active":"" ?>"><a href="<?php echo base_url() ?>transaksi_penjualan"><i class="fa fa-circle-o"></i> Transaksi Penjualan</a></li>
                <li class="<?php echo $this->uri->segment(1)=="transaksi_penjualan"?"active":"" ?>"><a href="<?php echo base_url() ?>transaksi_penjualan/index_edit_penjualan"><i class="fa fa-shopping-cart"></i> Edit Penjualan</a></li>
                <li class="<?php echo $this->uri->segment(1)=="transaksi_pengeluaran"?"active":"" ?>"><a href="<?php echo base_url() ?>transaksi_pengeluaran"><i class="fa fa-circle-o"></i> Transaksi Pengeluaran</a></li>
                <li class="<?php echo $this->uri->segment(1)=="sales_to_cicilan"?"active":"" ?>"><a href="<?php echo base_url() ?>sales_to_cicilan"><i class="fa fa-shopping-cart"></i> Sales To Cicilan</a></li>
<!--                 <li class="<?php echo $this->uri->segment(1)=="koperasi_transaksi_keluar"?"active":"" ?>"><a href="<?php echo base_url() ?>koperasi_transaksi_keluar"><i class="fa fa-circle-o"></i> Transaksi Pengeluaran</a></li> -->
                <li class="<?php echo $this->uri->segment(1)=="transaksi_simpanan"?"active":"" ?>"><a href="<?php echo base_url() ?>transaksi_simpanan"><i class="fa  fa-balance-scale"></i> Transaksi Simpanan</a></li>
                <li class="<?php echo $this->uri->segment(1)=="transaksi_pinjaman"?"active":"" ?>"><a href="<?php echo base_url() ?>transaksi_pinjaman"><i class="fa  fa-balance-scale"></i> Transaksi Pinjaman</a></li>
                <li class="<?php echo $this->uri->segment(1)=="transaksi_penarikan"?"active":"" ?>"><a href="<?php echo base_url() ?>transaksi_penarikan"><i class="fa  fa-balance-scale"></i> Transaksi Penarikan Simpanan</a></li>
              </ul>
            </li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Pembayaran</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $this->uri->segment(1)=="transaksi_submit_cicilan"?"active":"" ?>"><a href="<?php echo base_url() ?>transaksi_submit_cicilan"><i class="fa fa-balance-scale"></i> Pembayaran Cicilan</a></li>
                <li class="<?php echo $this->uri->segment(1)=="transaksi_submit_cicilan_bulanan"?"active":"" ?>"><a href="<?php echo base_url() ?>transaksi_submit_cicilan_bulanan"><i class="fa fa-balance-scale"></i> Submit Cicilan Bulanan</a></li>
                <li class="<?php echo $this->uri->segment(1)=="pelunasan_pinjaman_anggota"?"active":"" ?>"><a href="<?php echo base_url() ?>pelunasan_pinjaman_anggota"><i class="fa  fa-balance-scale"></i> Transaksi Pelunasan Pinjaman</a></li>
              </ul>
            </li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>Report</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $this->uri->segment(1)=="report_transaksi_pembelian"?"active":"" ?>"><a href="<?php echo base_url() ?>report_transaksi_pembelian"><i class="fa fa-circle-o"></i> Report Pembelian</a></li>
                <li class="<?php echo $this->uri->segment(1)=="report_transaksi_penjualan"?"active":"" ?>"><a href="<?php echo base_url() ?>report_transaksi_penjualan"><i class="fa fa-circle-o"></i> Report Penjualan</a></li>
                <li class="<?php echo $this->uri->segment(1)=="report_stok"?"active":"" ?>"><a href="<?php echo base_url() ?>report_stok"><i class="fa  fa-recycle"></i> Report Stok</a></li>
                <li class="<?php echo $this->uri->segment(1)=="history_stok"?"active":"" ?>"><a href="<?php echo base_url() ?>history_stok"><i class="fa  fa-recycle"></i> History Stok</a></li>
                <li class="<?php echo $this->uri->segment(1)=="report_top_brand"?"active":"" ?>"><a href="<?php echo base_url() ?>report_top_brand"><i class="fa fa-circle-o"></i> Report TOP Brand</a></li>
                <!-- <li class="<?php echo $this->uri->segment(1)=="report_mutasi_anggota"?"active":"" ?>"><a href="<?php echo base_url() ?>report_mutasi_anggota"><i class="fa fa-circle-o"></i> Report Mutasi Anggota</a></li> -->
                <li class="<?php echo $this->uri->segment(1)=="report_transaksi_pinjaman"?"active":"" ?>"><a href="<?php echo base_url() ?>report_transaksi_pinjaman"><i class="fa fa-balance-scale"></i> Report Trx Pinjaman</a></li>
                <li class="<?php echo $this->uri->segment(1)=="report_transaksi_simpanan"?"active":"" ?>"><a href="<?php echo base_url() ?>report_transaksi_simpanan"><i class="fa fa-balance-scale"></i> Report Trx Simpanan</a></li>
                <li class="<?php echo $this->uri->segment(1)=="report_transaksi_pembayaran"?"active":"" ?>"><a href="<?php echo base_url() ?>report_transaksi_pembayaran"><i class="fa fa-balance-scale"></i> Report Pembayaran</a></li>
                <li class="<?php echo $this->uri->segment(1)=="report_hutang_anggota"?"active":"" ?>"><a href="<?php echo base_url() ?>report_hutang_anggota"><i class="fa fa-balance-scale"></i> Report Hutang Anggota</a></li>
                <li class="<?php echo $this->uri->segment(1)=="report_resign_anggota"?"active":"" ?>"><a href="<?php echo base_url() ?>report_resign_anggota"><i class="fa fa-balance-scale"></i> Report Resign</a></li>
                <li class="<?php echo $this->uri->segment(1)=="report_mutasi_anggota" && empty($this->uri->segment(2)) ?"active":"" ?>"><a href="<?php echo base_url() ?>report_mutasi_anggota"><i class="fa fa-balance-scale"></i> Generate SHU</a></li>
                <li class="<?php echo $this->uri->segment(1)=="report_mutasi_anggota" && $this->uri->segment(2)=="report"?"active":"" ?>"><a href="<?php echo base_url() ?>report_mutasi_anggota/report"><i class="fa fa-balance-scale"></i> Report SHU</a></li>
             </ul>
            </li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-book"></i><span>Proses Bulanan</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $this->uri->segment(1)=="opname_stok"?"active":"" ?>"><a href="<?php echo base_url() ?>opname_stok"><i class="fa fa-circle-o"></i> Proses Opname</a></li>
                <li class="<?php echo $this->uri->segment(1)=="koperasi_stok_awal"?"active":"" ?>"><a href="<?php echo base_url() ?>koperasi_stok_awal"><i class="fa fa-circle-o"></i> Saldo Awal</a></li>   
                <li class="<?php echo $this->uri->segment(1)=="report_transaksi_penjualan"?"active":"" ?>"><a href="<?php echo base_url() ?>report_transaksi_penjualan"><i class="fa fa-circle-o"></i> Report Penjualan</a></li>
                <li class="<?php echo $this->uri->segment(1)=="report_stok"?"active":"" ?>"><a href="<?php echo base_url() ?>report_stok"><i class="fa fa-circle-o"></i> Report Stok</a></li>
                <li class="<?php echo $this->uri->segment(1)=="transaksi_elektronik"?"active":"" ?> hidden"><a href="<?php echo base_url() ?>transaksi_elektronik"><i class="fa fa-circle-o"></i> Transaksi Elektronik</a></li>
             </ul>
            </li>
            <Elektronik class="active treeview">
              <a href="#">
                <i class="fa fa-book"></i><span>Cetak </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $this->uri->segment(1)=="opname_stok"?"active":"" ?>"><a href="<?php echo base_url() ?>opname_stok"><i class="fa fa-circle-o"></i> Cetak Bukti Bayar Pinjaman</a></li>
                <li class="<?php echo $this->uri->segment(1)=="transaksi_resign"?"active":"" ?>"><a href="<?php echo base_url() ?>transaksi_resign"><i class="fa fa-balance-scale"></i> Form Resign</a></li>
<!--                 <li class="<?php echo $this->uri->segment(1)=="testing_samuel"?"active":"" ?>"><a href="<?php echo base_url() ?>testing_samuel"><i class="fa fa-circle-o"></i> Testing Samuel</a></li> -->
             </ul>
            </li>
           <!--  <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Layout Options</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li>-->
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <div class="content-wrapper">