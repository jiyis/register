@extends('admin.layouts.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            {!! Breadcrumbs::render('admin-registers-create') !!}
        </section>
        <section class="content container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">添加报名成员</h4>
                        </div>

                        {!! Form::open(['route' => 'admin.registers.store','class' => 'form-horizontal form-bordered']) !!}

                            @include('admin.registers.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection