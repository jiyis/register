<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>苏州科技学院--敬文书院报名系统</title>

    @section('css')
        <link rel="stylesheet" href="{{ elixir('assets/css/frontend.css') }}">
    @show

</head>
<body>

    @yield('content')

    @section('javascript')
        <script src="{{ elixir('assets/js/frontend.js') }}"></script>
        {!! Toastr::render() !!}
    @show

</body>
</html>
