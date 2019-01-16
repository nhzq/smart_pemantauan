<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('content.title') }}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.5/css/AdminLTE.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/dist/css/nhzq.css') }}">
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="shortcut icon" type="image/png" href="{{ asset('selangor.ico') }}"/>
        <style>
            .login-wrapper {
                margin: 7% auto;
                width: 30%;
            }
        </style>
    </head>
    <body class="hold-transition login-page" style="
        background-image: linear-gradient(rgba(155, 0, 4, .3), rgba(155, 0, 4, .9)), url('https://www.selangor.gov.my/index/resources/bangunan_ssaas_drone2.JPG');
        background-repeat: no-repeat;
        background-size: 100%;
        overflow: hidden;
    ">
        <div class="login-wrapper">
            <div class="panel panel-borderless">
                <div class="panel-heading panel-maroon">
                    <div class="text-center mrg10B">
                        <img src="{{ asset('selangor.ico') }}" style="max-width: 40px;">
                    </div>
                    <div class="text-center">
                        {{ config('content.title') }}
                    </div>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                        
                        <div class="form-group has-feedback {{ $errors->has('ic') ? 'has-error' : '' }}">
                            <label for="ic">No Kad Pengenalan</label>
                            <input name="ic" type="text" class="form-control" placeholder="No Kad Pengenalan" value="{{ old('ic') }}" required autofocus>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="ic">Kata Laluan</label>
                            <input name="password" type="password" class="form-control" placeholder="Kata Laluan" required>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-xs-4 pull-right">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Log Masuk</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
