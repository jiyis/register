<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Jiyi Backend CMS</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @section('css')
        <link rel="stylesheet" href="{{ elixir('assets/css/admin.css') }}">
        @show
    <style type="text/css">
        body.notfound {
            background: #e4e7ea;
        }
        .lockedpanel {
            width: 250px;
            margin: 10% auto 0 auto;
            text-align: center;
        }

        .lockedpanel .loginuser {
            text-align: center;
        }

        .lockedpanel .loginuser img {
            -moz-border-radius: 100px;
            -webkit-border-radius: 100px;
            border-radius: 100px;
            background: rgba(255,255,255,0.4);
            padding: 5px;
        }

        .lockedpanel .locked {
            font-size: 42px;
            margin-bottom: 20px;
        }

        .lockedpanel .logged {
            margin-top: 20px;
        }

        .lockedpanel .logged h4 {
            margin: 0;
            font-size: 21px;
            color: #333;
        }

        .lockedpanel form {
            margin-top: 20px;
        }

        .lockedpanel form .btn {
            display: block;
            margin-top: 10px;
        }
    </style>

                <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="notfound" style="overflow: visible;">

<!-- Preloader -->
<!-- <div id="preloader" style="display: none;">
    <div id="status" style="display: none;"><i class="fa fa-spinner fa-spin"></i></div>
</div> -->

<section>

    <div class="lockedpanel">
        <div class="locked">
            <i class="fa fa-lock"></i>
        </div>
        <div class="logged">
            <h4>403</h4>
            <small class="text-muted">对不起，你没有权限操作这个页面</small>
        </div>
        <form method="post" action="#">
            <a href="{{ route('admin.home') }}" class="btn btn-success btn-block">首页</a>

            <a href="{{ $previousUrl }}" class="btn btn-success btn-block">点击返回</a>
        </form>
    </div><!-- lockedpanel -->

</section>


</body>
</html>
