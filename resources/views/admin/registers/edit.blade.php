@extends('admin.layouts.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            {!! Breadcrumbs::render('admin-registers-edit') !!}
        </section>
        <section class="content container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">编辑报名成员</h4>
                        </div>

                       {!! Form::model($register, ['route' => ['admin.registers.update', $register->id], 'method' => 'patch']) !!}

                        @include('admin.registers.fields')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </section>
@endsection