@extends('admin.layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {!! Breadcrumbs::render('admin-permission-edit') !!}
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">

                @include('admin._partials.rbac-left-menu')
                <div class="col-sm-9 col-lg-10">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">编辑权限</h4>
                        </div>

                        {!! Form::model($permission, ['route' => ['admin.permission.update', $permission],'class' => 'form-horizontal form-bordered', 'method' => 'patch', 'files' => true ]) !!}

                        @include('admin.rbac.permissions.fields')

                        {!! Form::close() !!}

                    </div>

                </div><!-- col-sm-9 -->
            </div>
        </section>
    </div>
@endsection
