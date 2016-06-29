@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">报名系统</div>
                {!! Form::open(['route' => 'home.store','class' => 'dropzone form-horizontal form-bordered register','files' => true]) !!}

                @include('index.fields')

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection
