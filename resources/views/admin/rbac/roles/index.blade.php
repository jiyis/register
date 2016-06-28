@extends('admin.layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {!! Breadcrumbs::render('admin-role-index') !!}
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
                                <a href="{{ route('admin.role.create') }}" class="btn btn-white tooltips"
                                   data-toggle="tooltip" data-original-title="新增"><i
                                            class="glyphicon glyphicon-plus"></i></a>
                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
                                   data-original-title="删除" data-href="{{ route('admin.role.destroy.all') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </div><!-- pull-right -->

                        <h5 class="subtitle mb5">角色列表</h5>


                        <div class="table-responsive col-md-12">
                            <table class="table mb30">
                                <thead>
                                <tr>
                                    <th>
                                        <label>
                                            <input type="checkbox" class="square" id="selectall">
                                        </label>
                                    </th>
                                    <th>标识</th>
                                    <th>角色名</th>
                                    <th>说明</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" class="square selectall-item" name="id" id="id-{{ $role->id }}" value="{{ $role->id }}" />
                                            </label>
                                        </td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->display_name }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>{{ $role->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.role.edit',['id'=>$role->id]) }}"
                                               class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>
                                            <a href="{{ route('admin.role.permissions',['id'=>$role->id]) }}"
                                               class="btn btn-info btn-xs role-permissions"><i class="fa fa-wrench"></i> 权限</a>
                                            <a class="btn btn-danger btn-xs role-delete"
                                               data-href="{{ route('admin.role.destroy',['id'=>$role->id]) }}">
                                                <i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            {!! $roles->render() !!}
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
        $(".role-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除角色?',
                href: $(this).data('href'),
                successTitle: '角色删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的角色?',
                href: $(this).data('href'),
                successTitle: '角色删除成功'
            });
        });
    </script>

@endsection
