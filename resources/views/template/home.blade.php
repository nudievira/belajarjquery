<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) ? $title : 'Home' }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('template/dist/css/adminlte.min.css') }}">
    @stack('css')
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    @if ($errors->any())
        <div class="error-post" data-msg="Invalid Input!"></div>
    @endif
    @if (session()->has('success'))
        <div class="success-info" data-msg="{{ session('success') }}"></div>
    @endif
    @if (session()->has('error'))
        <div class="error-info" data-msg="{{ session('error') }}"></div>
    @endif
    <div class="wrapper">
        <!-- Navbar -->
        @include('template.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('template.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            <!-- /.content-wrapper -->
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <!-- ./wrapper -->

            <!-- REQUIRED SCRIPTS -->
            @stack('modal-add')
            @stack('modal-edt')

            <!-- jQuery -->
            <script src="{{ url('template/plugins/jquery/jquery.min.js') }}"></script>
            <!-- Bootstrap -->
            <script src="{{ url('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <!-- AdminLTE -->
            <script src="{{ url('template/dist/js/adminlte.js') }}"></script>

            <!-- OPTIONAL SCRIPTS -->
            <script src="{{ url('template/plugins/chart.js/Chart.min.js') }}"></script>
            <!-- AdminLTE for demo purposes -->
            {{-- <script src="{{ url('template/dist/js/demo.js') }}"></script> --}}
            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            <script src="{{ url('template/dist/js/pages/dashboard3.js') }}"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    var errorPost = $('.error-post').data('msg');
                    var success = $('.success-info').data('msg');
                    var error = $('.error-info').data('msg');
                    if (errorPost) {
                        $('#addModal').modal("show")
                        console.log('error post');
                    }
                    if (error || success) {
                        alert(error || success)
                    }
                })
            </script>
            @stack('script')
</body>

</html>
