@extends('admin.layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {!! Breadcrumbs::render('admin-role-edit') !!}
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
                            <h4 class="panel-title">编辑用户</h4>
                        </div>

                        {!! Form::model($role, ['route' => ['admin.role.update', $role],'class' => 'form-horizontal form-bordered', 'method' => 'patch', 'files' => true ]) !!}

                        @include('admin.rbac.roles.fields')

                        {!! Form::close() !!}

                    </div>

                </div><!-- col-sm-9 -->
            </div>
        </section>
    </div>
@endsection
