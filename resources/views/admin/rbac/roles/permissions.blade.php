@extends('admin.layouts.admin')

@section('css')
    @parent
    <style>
        .sub-permissions-ul li {
            float: left;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {!! Breadcrumbs::render('admin-role-permission') !!}
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                @include('admin._partials.rbac-left-menu')

                <div class="col-sm-9 col-lg-10">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">编辑 [{{ $role->display_name }}] 权限</h4>
                    </div>

                    <form action="{{ route('admin.role.permissions',['id'=>$role->id]) }}" method="post"
                          id="role-permissions-form">
                        <div class="panel-body panel-body-nopadding">
                            @foreach($permissions as $permission)
                                <div class="top-permission col-md-12">
                                    <a href="javascript:;" class="display-sub-permission-toggle">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </a>
                                    @if(in_array($permission['id'],array_keys($rolePermissions)))
                                        <label>
                                            <input type="checkbox"  name="permissions[]" class="square top-permission-checkbox" value="{{ $permission['id'] }}" checked/>
                                        </label>
                                    @else
                                        <label>
                                            <input type="checkbox"  name="permissions[]" class="square top-permission-checkbox" value="{{ $permission['id'] }}"/>
                                        </label>
                                    @endif
                                    <label><h5>&nbsp;&nbsp;{{ $permission['display_name'] }}</h5></label>

                                    @if(count($permission['subPermission']))
                                        <div class="sub-permissions col-md-11 col-md-offset-1">
                                            @foreach($permission['subPermission'] as $sub)
                                                <div class="col-sm-3">
                                                    @if($sub['is_menu'])
                                                        <label>
                                                            <input type="checkbox" name="permissions[]"
                                                                      value="{{ $sub['id'] }}"
                                                                      class="square sub-permission-checkbox" {{ in_array($sub['id'],array_keys($rolePermissions)) ? 'checked':'' }}/>&nbsp;&nbsp;<span
                                                                    class="fa fa-bars"></span>{{ $sub['display_name'] }}
                                                        </label>
                                                    @else
                                                        <label>
                                                            <input type="checkbox" name="permissions[]"
                                                                      value="{{ $sub['id'] }}"
                                                                      class="square sub-permission-checkbox" {{ in_array($sub['id'],array_keys($rolePermissions)) ? 'checked':'' }}/>&nbsp;&nbsp;{{ $sub['display_name'] }}
                                                        </label>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            {{ csrf_field() }}
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn bg-purple"  id="save-role-permissions">保存</button>
                                    &nbsp;
                                    <a href="{{ route('admin.role.index') }}" class="btn btn-default">取消</a>
                                </div>
                            </div>
                        </div><!-- panel-footer -->

                    </form>

                </div>

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
            $("#save-role-permissions").click(function (e) {
                e.preventDefault();
                Rbac.ajax.request({
                    href: $("#role-permissions-form").attr('action'),
                    data: $("#role-permissions-form").serialize(),
                    successTitle: '角色权限保存成功'
                });
            });
        })

        $(".display-sub-permission-toggle").click(function () {
            var sub = $(this).find('span');
            if (sub.hasClass("glyphicon-minus")) {
                $(this).children('span').removeClass('glyphicon-minus').addClass('glyphicon-plus')
                        .parents('.top-permission').find('.sub-permissions').hide();
            } else {
                $(this).children('span').removeClass('glyphicon-plus').addClass('glyphicon-minus')
                        .parents('.top-permission').find('.sub-permissions').show();
            }
        });



        var checkAll = $('.top-permission-checkbox');
        var checkboxes = $('.sub-permission-checkbox');
        var touchIf = 0; //判断是否是点击了子checkbox 后去选中父级checkbox

        //父级根据touchIf 的值来判断是否是用户自己点击的子checkbox，从而防止错误逻辑选中
        checkAll.on('ifChecked ifUnchecked', function(event) {
            if (event.type == 'ifChecked') {
                if(touchIf == 0){
                    $(this).parents('.top-permission').find('.sub-permissions').find('input').iCheck('check');
                }else{
                    touchIf = 0;
                }
            } else {
                $(this).parents('.top-permission').find('.sub-permissions').find('input').iCheck('uncheck');
            }
        });
        //子checkbox采用判断点击的方法，防止和全选和取消选中发生冲突
        checkboxes.on('ifClicked', function(event){
            var parent = $(this).parents('.top-permission').find('.top-permission-checkbox');
            var hasCheckedNum = checkboxes.filter(':checked').length;
            var status = $(this).prop('checked');
            if(status == false){
                touchIf = 1;
                parent.iCheck('check');
            }else {
                if(hasCheckedNum == 0){
                    parent.iCheck('uncheck');
                    touchIf = 0;
                }
            }
        });

    </script>

@endsection