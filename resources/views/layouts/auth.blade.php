<?php 
    $assets = [
        'css' => [
            'components/bootstrap/dist/css/bootstrap.min.css',
            'components/font-awesome/css/font-awesome.min.css',
            'components/Ionicons/css/ionicons.min.css',
            'plugins/iCheck/square/blue.css',
            'dist/css/AdminLTE.min.css',
        ], 
        'js' => [
            'components/jquery/dist/jquery.min.js',
            'components/bootstrap/dist/js/bootstrap.min.js',
            'plugins/iCheck/icheck.min.js',
        ]
    ];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        @foreach ($assets['css'] as $css)
            <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/' . $css) }}">
        @endforeach
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    
    @yield ('body')

    @foreach ($assets['js'] as $js)
        <script src="{{ asset('adminlte/' . $js) }}"></script>
    @endforeach
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
</html>
