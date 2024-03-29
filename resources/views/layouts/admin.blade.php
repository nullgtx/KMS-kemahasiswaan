<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/dist/css/adminlte.min.css">
  <!-- sweet alert -->
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/sweetalert2/sweetalert2.css">
  <link rel="stylesheet" href="{{ url('/') }}/AdminLTE/plugins/sweetalert2/sweetalert2.min.css">
  @stack('head')
</head>
<body class="hold-transition login-page">
@yield('content')

<!-- jQuery -->
<script src="{{ url('/') }}/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/') }}/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- sweet alert -->
<script src="{{ url('/') }}/AdminLTE/plugins/sweetalert2/sweetalert2.js"></script>
<script src="{{ url('/') }}/AdminLTE/plugins/sweetalert2/sweetalert2.all.js"></script>
<script src="{{ url('/') }}/AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="{{ url('/') }}/AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/AdminLTE/dist/js/adminlte.min.js"></script>
@stack('scripts')
@include('sweet::alert')
</body>
</html>
