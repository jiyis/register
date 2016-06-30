@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>报名系统</h4></div>
                {!! Form::open(['route' => 'home.store','class' => 'form-horizontal form-bordered register','files' => true]) !!}

                @include('index.fields')

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection
