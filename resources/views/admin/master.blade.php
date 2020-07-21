<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/font-awesome/css/font-awesome.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- sweet alert -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/sweetalert2/sweetalert2.css">
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/sweetalert2/sweetalert2.min.css">
  <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/summernote/summernote-bs4.min.css">
  @stack('head')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed ">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home 
                        @can('is_admin')
                        Administrator
                        @elsecan('is_operator')
                        Kemahasiswaan
                        @endcan </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="{{ url('/') }}/AdminLTE/dist/img/kmslogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" ">
      <span class="brand-text font-weight-light">KMS IT Telkom</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::user()->photo_url }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('admin.profile.index') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if(Auth::user()->admin->level=='kemahasiswaan')
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p class="text">Dashboard</p>
            </a>
          </li>
          @else
          @endif
          @if(Auth::user()->admin->level=='admin')                      
          <li class="nav-item">
            <a href="{{ route('admin.admins.index') }}" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p class="text">Kelola Admin</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.members.index') }}" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p class="text">Kelola Mahasiswa</p>
            </a>
          </li>
          @else
          <li class="nav-item">
            <a href="{{ route('admin.spm.index') }}" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p class="text">Kelola Dokumen SOP</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.kegiatan.index') }}" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p class="text">Kelola Dokumen Kegiatan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.articles.index') }}" class="nav-link">
              <i class="nav-icon fa fa-newspaper-o"></i>
              <p class="text">Kelola Berita</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.knowledge.index') }}" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p class="text">Kelola Pengetahuan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.forum.index') }}" class="nav-link">
              <i class="nav-icon fa fa-comments"></i>
              <p class="text">Forum Diskusi</p>
            </a>
          </li>
          @endif
          
          <li class="nav-item">
            <a href="{{ route('admin.profile.index') }}" class="nav-link">
              <i class="nav-icon fa fa-wrench"></i>
              <p class="text">Ubah Pengguna</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon fa fa-sign-out"></i>
              <p class="text">Keluar</p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content') 
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-pre
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('/') }}/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('/') }}/AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('/') }}/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="{{ url('/') }}/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('/') }}/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url('/') }}/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- sweet alert -->
<script src="{{ url('/') }}/AdminLTE/plugins/sweetalert2/sweetalert2.js"></script>
<script src="{{ url('/') }}/AdminLTE/plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="{{ url('/') }}/AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="{{ url('/') }}/AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- ChartJS -->
<script src="{{ url('/') }}/AdminLTE/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ url('/') }}/AdminLTE/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ url('/') }}/AdminLTE/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ url('/') }}/AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('/') }}/AdminLTE/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ url('/') }}/AdminLTE/plugins/moment/moment.min.js"></script>
<script src="{{ url('/') }}/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('/') }}/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ url('/') }}/AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ url('/') }}/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/AdminLTE/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('/') }}/AdminLTE/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/') }}/AdminLTE/dist/js/demo.js"></script>
@stack('scripts')
@include('sweet::alert')
</body>
</html>
