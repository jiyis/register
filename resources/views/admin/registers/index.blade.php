@extends('admin.layouts.admin')

@section('content')
	<div class="content-wrapper">
        <section class="content-header">
            {!! Breadcrumbs::render('admin-registers-index') !!}
        </section>

        <!-- Main content -->
        <section class="content container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
	                <div class="panel panel-default">
	                    <div class="panel-body">
	                        <div class="pull-right">
	                            <div class="btn-group mr10">
	                                <a href="{!! route('admin.registers.create') !!}" class="btn btn-white tooltips"
	                                   data-toggle="tooltip" data-original-title="新增"><i
	                                            class="glyphicon glyphicon-plus"></i></a>
	                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
	                                   data-original-title="删除" data-href="{!! route('admin.registers.destroy.all') !!}"><i
	                                            class="glyphicon glyphicon-trash"></i></a>
	                            </div>
	                        </div><!-- pull-right -->

	                        <h5 class="subtitle mb5">报名成员列表</h5>
 							<div class="table-responsive col-md-12">
	                            @if($registers->isEmpty())
	                                <div class="well text-center">暂无报名成员信息！</div>
	                            @else
	                                @include('admin.registers.table')
	                            @endif
	                        </div>

                            <div class="row">
                                {!! $registers->render() !!}
                            </div>

						</div><!-- panel-body -->
                	</div>
            	</div>
            </div>
        </section>
    </div>
@endsection
