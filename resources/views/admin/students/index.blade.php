@extends('admin.layouts.admin')
@section('css')
    @parent
    <link href="{{ asset('assets/plugins/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
    <style type="text/css">
        .table tbody tr td{
            line-height: 50px;
        }
    </style>

@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {!! Breadcrumbs::render('admin-student-index') !!}
        </section>

        <!-- Main content -->
        <section class="content container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="{{ route('admin.students.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.students.destroy.all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                                <a class="btn btn-info tooltips various" data-toggle="tooltip"
                                   data-fancybox-type="iframe" href="{{ route('admin.upload') }}" ><i class="fa fa-share"></i>批量导入</a>
                                <a class="btn btn-danger tooltips" href="{{ route('admin.students.delete.all') }}"><i
                                            class="glyphicon glyphicon-trash"></i>全部删除</a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">用户列表</h5>


                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>
                                        <label>
                                            <input type="checkbox" class="square" id="selectall">
                                        </label>
                                        <!--<span class="ckbox ckbox-primary">
                                            <input type="checkbox" id="selectall"/>
                                            <label for="selectall"></label>
                                        </span>-->
                                    </th>
                                    <th>考生号</th>
                                    <th>姓名</th>
                                    <th>邮箱</th>
                                    <th>头像</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" class="square selectall-item" name="id" id="id-{{ $user->id }}" value="{{ $user->id }}" />
                                            </label>
                                        </td>
                                        <td>{{ $user->student_id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{!! $user->email !!}</td>
                                        <td>
                                            <img src="{!! '/'.$user->userpic !!}" width="50" height="50">
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.students.edit',['id'=>$user->id]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>
                                            <a class="btn btn-danger btn-xs user-delete"
                                               data-href="{{ route('admin.students.destroy',['id'=>$user->id]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            {!! $users->render() !!}
                        </div>

                    </div><!-- panel-body -->
                </div><!-- panel -->

                </div><!-- col-sm-9 -->

            </div><!-- row -->
        </section>

    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('assets/plugins/fancybox/jquery.fancybox.pack.js') }}"></script>
    <script type="text/javascript">
        $(function(){

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
                checkboxClass: 'icheckbox_square-purple',
                radioClass: 'iradio_square-purple'
            });

            $(".various").fancybox({
                maxWidth	: 900,
                maxHeight	: 500,
                fitToView	: false,
                width		: '70%',
                height		: '70%',
                autoSize	: false,
                closeClick	: false,
                openEffect	: 'none',
                closeEffect	: 'none'
            });
        })
        $(".user-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除用户?',
                href: $(this).data('href'),
                successTitle: '用户删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的用户?',
                href: $(this).data('href'),
                successTitle: '用户删除成功'
            });
        });
    </script>

@endsection
