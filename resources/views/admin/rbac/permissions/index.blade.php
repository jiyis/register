@extends('admin.layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {!! Breadcrumbs::render('admin-permission-index') !!}
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                @include('admin._partials.rbac-left-menu')

                <div class="col-sm-9 col-lg-10">

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="pull-right">
                            <div class="btn-group mr10">
                                <a href="{{ route('admin.permission.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.permission.destroy.all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">权限列表</h5>


                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>
                                        <label>
                                            <input type="checkbox" class="square" id="selectall">
                                        </label>
                                    </th>
                                    <th>显示名称</th>
                                    <th>路由</th>
                                    <th>图标</th>
                                    <th>说明</th>
                                    <th>是否菜单</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" class="square selectall-item" name="id" id="id-{{ $permission->id }}" value="{{ $permission->id }}" />
                                            </label>
                                            <label for="id-{{ $permission->id }}"></label>
                                            <a href="javascript:;" class="show-sub-permissions"
                                               data-id="{{ $permission['id'] }}"><span
                                                        class="glyphicon glyphicon-chevron-right"></span></a>
                                        </td>
                                        <td><p class="text-info">{{ $permission->display_name }}</p></td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{!! $permission->icon_html !!}</td>
                                        <td>{{ $permission->description }}</td>
                                        <td>{!! $permission->is_menu ? '<span class="label label-danger">是</span>':'<span class="label label-default">否</span>' !!}</td>
                                        <td>
                                            <a href="{{ route('admin.permission.edit',['id'=>$permission->id]) }}"
                                               class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑</a>
                                            <a class="btn btn-danger btn-sm permission-delete"
                                               data-href="{{ route('admin.permission.destroy',['id'=>$permission->id]) }}"><i
                                                        class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>

                                    @if($permission->sub_permission->count())
                                        @foreach($permission->sub_permission as $sub)
                                            <tr class=" parent-permission-{{ $permission->id }} hide">
                                                <td>
                                                    <label>
                                                        <input type="checkbox" class="square selectall-item" name="id" id="id-{{ $sub->id }}" value="{{ $sub->id }}" />
                                                    </label>
                                                    <label for="id-{{ $sub->id }}"></label>
                                                </td>
                                                <td>|-- {{ $sub->display_name }}</td>
                                                <td>{{ $sub->name }}</td>
                                                <td>{!! $sub->icon_html !!}</td>
                                                <td>{{ $sub->description }}</td>
                                                <td>{!! $sub->is_menu ? '<span class="label label-danger">是</span>':'<span class="label label-default">否</span>' !!}</td>
                                                <td>
                                                    <a href="{{ route('admin.permission.edit',['id'=>$sub->id]) }}"
                                                       class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> 编辑</a>
                                                    <a class="btn btn-danger btn-sm permission-delete"
                                                       data-href="{{ route('admin.permission.destroy',['id'=>$sub->id]) }}"><i
                                                                class="fa fa-trash-o"></i> 删除</a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            {!! $permissions->render() !!}
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
    <script type="text/javascript">
        $(function(){

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
                checkboxClass: 'icheckbox_square-purple',
                radioClass: 'iradio_square-purple'
            });

        })
        $(".show-sub-permissions").click(function () {
            var id = $(this).data('id'), subSelector = $('.parent-permission-' + id);
            if (subSelector.hasClass("hide")) {
                $(this).children('.glyphicon').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
                subSelector.removeClass('hide');
            } else {
                $(this).children('.glyphicon').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');
                subSelector.addClass('hide');
            }
        });

        $(".permission-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除该权限吗？如果该权限有下属权限将被一起删除！',
                href: $(this).data('href'),
                successTitle: '权限删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的权限吗？如果该权限有下属权限将被一起删除！',
                href: $(this).data('href'),
                successTitle: '权限删除成功'
            });
        });
    </script>

@endsection
