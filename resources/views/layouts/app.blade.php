<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('assets/img/shop-2.png') }}" type="image/x-icon">

  <title>{{ $title ?? config('app.name') }} - Admin Online Shop</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <style>
    .form-control:focus {
      color: #6e707e;
      background-color: #fff;
      border-color: #375dce;
      outline: 0;
      box-shadow: none
    }
    .form-group label {
      font-weight: bold
    }
    #wrapper #content-wrapper {
      background-color: #e2e8f0;
      width: 100%;
      overflow-x: hidden;
    }
    .card-header {
      padding: .75rem 1.25rem;
      margin-bottom: 0;
      background-color: #4e73de;
      border-bottom: 1px solid #e3e6f0;
      color: white;
    }
  </style>

  <!-- jQuery -->
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

  <!-- sweet alert -->
  <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('layouts.partial._sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- navbar -->
        @include('layouts.partial._nav')
        <!-- End of navbar -->

        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  @include('layouts.partial._logout-modal')

  {{-- script --}}
  @include('layouts.partial._script')

</body>
</html>
