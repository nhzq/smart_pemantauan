<?php
    $assets = [
        'css' => [
            'components/bootstrap/dist/css/bootstrap.min.css',
            'components/font-awesome/css/font-awesome.min.css',
            'components/Ionicons/css/ionicons.min.css',
            'components/morris.js/morris.css',
            'components/jvectormap/jquery-jvectormap.css',
            'components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
            'components/bootstrap-daterangepicker/daterangepicker.css',
            'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
            'dist/css/AdminLTE.min.css',
            'dist/css/spacing.css',
            'dist/css/skins/skin-blue.min.css',
        ],
        'js' => [
            'components/jquery/dist/jquery.min.js',
            'components/jquery-ui/jquery-ui.min.js',
            'components/bootstrap/dist/js/bootstrap.min.js',
            'components/raphael/raphael.min.js',
            'components/morris.js/morris.min.js',
            'components/jquery-sparkline/dist/jquery.sparkline.min.js',
            'components/jquery-knob/dist/jquery.knob.min.js',
            'components/moment/min/moment.min.js',
            'components/bootstrap-daterangepicker/daterangepicker.js',
            'components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
            'components/jquery-slimscroll/jquery.slimscroll.min.js',
            'components/fastclick/lib/fastclick.js',
            'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
            'plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
            'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
            'dist/js/adminlte.min.js',
            'dist/js/pages/dashboard.js',
            'dist/js/demo.js',
        ]
    ];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      
        @foreach ($assets['css'] as $css)
            <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/' . $css) }}">
        @endforeach
        @stack ('css')
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!-- Header -->
            @include ('components._header')

            <!-- Left sidebar -->
            @include ('components._leftsidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield ('content')
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.4.0
                </div>
                <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
                reserved.
            </footer>
        </div>
        <!-- ./wrapper -->
  

        @foreach ($assets['js'] as $js)
            <script src="{{ asset('adminlte/' . $js) }}"></script>
        @endforeach
        @stack ('script')
    </body>
</html>
