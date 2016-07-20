@extends('layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">编辑用户(*为必填)</h4>
                        </div>

                        {!! Form::model($user, ['route' => ['user.update', $user],'class' => 'form-horizontal form-bordered', 'method' => 'patch', 'files' => true ]) !!}

                        @include('index.user.fields')

                        {!! Form::close() !!}

                    </div>

                </div><!-- col-sm-9 -->
            </div>
        </section>
    </div>
@endsection

