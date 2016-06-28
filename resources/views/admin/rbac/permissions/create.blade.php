@extends('admin.layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {!! Breadcrumbs::render('admin-permission-create') !!}
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                @include('admin._partials.rbac-left-menu')

                <div class="col-sm-9 col-lg-10">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <!--<div class="panel-btns">
                                <a href="" class="panel-close">×</a>
                                <a href="" class="minimize">−</a>
                            </div>-->
                            <h4 class="panel-title">添加权限</h4>
                        </div>

                        {!! Form::open(['route' => 'admin.permission.store','class' => 'form-horizontal form-bordered']) !!}

                            @include('admin.rbac.permissions.fields')

                        {!! Form::close() !!}
                    </div>

                </div><!-- col-sm-9 -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
