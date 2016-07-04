@extends('admin.layouts.admin')
@section('css')
	<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
	@parent
@endsection

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
	                                   data-toggle="tooltip" data-original-title="新增"><i class="glyphicon glyphicon-plus"></i></a>
	                                <a class="btn btn-white tooltips deleteall" data-toggle="tooltip"
	                                   data-original-title="删除" data-href="{!! route('admin.registers.destroy.all') !!}"><i class="glyphicon glyphicon-trash"></i></a>
                                    <a class="btn btn-info tooltips multiexport" data-toggle="tooltip"
                                       data-original-title="批量导出" ><i class="fa fa-share"></i>批量导出</a>
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

						</div><!-- panel-body -->
                	</div>
            	</div>
            </div>
        </section>
    </div>
@endsection
@section('javascript')
	@parent
	<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
	<script type="text/javascript">
		//iCheck for checkbox and radio inputs
		$('input[type="checkbox"].square, input[type="radio"].square').iCheck({
			checkboxClass: 'icheckbox_square-purple',
			radioClass: 'iradio_square-purple'
		});
		$(".user-delete").click(function () {
			Rbac.ajax.delete({
				confirmTitle: '确定删除该Matches?',
				href: $(this).data('href'),
				successTitle: 'Matches删除成功'
			});
		});

		$(".deleteall").click(function () {
			Rbac.ajax.deleteAll({
				confirmTitle: '确定删除选中的Matches?',
				href: $(this).data('href'),
				successTitle: 'Matches删除成功'
			});
		});
        //审核学生
        $(".check").click(function () {
            Rbac.ajax.check({
                confirmTitle: '确定要审核该学生吗？',
                href: $(this).data('href'),
                successTitle: '学生报名审核成功！'
            });
        });
        //批量导出
        $('.multiexport').click(function () {
            var ids = [];
            $(".selectall-item").each(function (e) {
                if ($(this).prop('checked')) {
                    //ids.push($(this).val());
                    ids = ids + ',' + $(this).val();
                }
            });

            if (ids.length == 0) {
                swal('请选择需要导出的记录', '', 'warning');
                return false;
            }
            var url = "{{ route('admin.export.all') }}";
            url = url + '?ids=' + ids;
            window.location.href = url;
        })

		$(function(){
			$('#datatables').dataTable({
				columnDefs:[{
					orderable:false,//禁用排序
					'aTargets':[0,3,4,5,6,9,10]   //指定的列
				}],
				order: [[ 1, "asc" ]],
				autoWidth: true,
				language: {
					url: '/assets/language/datatables-zh.json'
				}
			});
		})
	</script>
@endsection