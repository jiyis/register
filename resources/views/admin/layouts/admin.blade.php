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


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="sidebar-mini skin-purple">
<div class="wrapper">
    <!-- 引入公共的头部部分 -->
    @include('admin._partials.header')

    <!-- 引入公共的左侧菜单部分 -->
    @include('admin._partials.left')

    @yield('content')

    <!-- 引入公共的尾部部分 -->
    @include('admin._partials.footer')

</div>

@section('javascript')
    <script src="{{ elixir('assets/js/admin.js') }}"></script>
    {!! Toastr::render() !!}
@show

</body>
</html>
