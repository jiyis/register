@extends('admin.layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {!! Breadcrumbs::render('admin-student-create') !!}
        </section>

        <!-- Main content -->
        <section class="content container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <!--<div class="panel-btns">
                                <a href="" class="panel-close">×</a>
                                <a href="" class="minimize">−</a>
                            </div>-->
                            <h4 class="panel-title">添加用户</h4>
                        </div>

                        {!! Form::open(['route' => 'admin.students.store','class' => 'form-horizontal form-bordered']) !!}

                            @include('admin.students.fields')

                        {!! Form::close() !!}
                    </div>

                </div><!-- col-sm-9 -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
