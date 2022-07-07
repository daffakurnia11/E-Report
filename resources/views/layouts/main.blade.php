<!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/img/favicon-32x32.png" type="image/png" />
  <!--plugins-->
  <link href="/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <link href="/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <!-- Date Time Picker -->
	<link rel="stylesheet" href="/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!-- Bootstrap CSS -->
  <link href="/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/plugins/bootstrap/dist/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  
  <link href="/css/style.css" rel="stylesheet" />
  <!--Theme Styles-->
  <link href="/css/dark-theme.css" rel="stylesheet" />
  <link href="/css/light-theme.css" rel="stylesheet" />
  <link href="/css/semi-dark.css" rel="stylesheet" />
  <link href="/css/header-colors.css" rel="stylesheet" />

  <title>E-Report App</title>
</head>

<body>

  @if (session()->has('message'))
    <div id="flash-data" data-flashdata="{{ session('message') }}"></div>
  @endif
  <!--start wrapper-->
  <div class="wrapper">
    @yield('header')

    @yield('sidebar')
          
    @yield('content')

    <!--start overlay-->
    <div class="overlay nav-toggle-icon"></div>
    <!--end overlay-->

    <!--Start Back To Top Button-->
      <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->

    @yield('switcher')

  </div>
  <!--end wrapper-->


  <!-- Bootstrap bundle JS -->
  <script src="/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--plugins-->
  <script src="/plugins/jquery/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="/plugins/metismenu/js/metisMenu.min.js"></script>
  <script src="/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
  <script src="/plugins/sweetalert2/dist/sweetalert2.all.js"></script>
  <script src="/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>
	<script src="/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>
  <!--app-->
  <script src="/js/app.js"></script>
  <script src="/js/notification.js"></script>
  @yield('custom-js')

</body>

</html>