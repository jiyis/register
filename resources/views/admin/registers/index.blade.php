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
									@if($state)
										<a class="btn btn-danger tooltips registeropen" data-toggle="tooltip" data-original-title="完成报名" ><i class="fa fa-cloud-download"></i>删除录取名单</a>
										@else
										<a class="btn btn-success tooltips registerclose" data-toggle="tooltip" data-original-title="完成报名" ><i class="fa fa-cloud-download"></i>生成录取名单</a>
									@endif
	                            </div>
	                        </div><!-- pull-right -->

	                        <h4 class="subtitle mb5">报名成员列表 <span style="font-size: 14px;padding-left: 8px;color: firebrick">当前共有<b style="color: #3b97d7;padding: 0 5px;">{{ $registerCount }}个学生在已审核状态</b>,<b style="color: darkorange;padding: 0 5px;">{{ $unenrollCount }}个学生已初审未录取</b><b style="color: darkorange;padding: 0 5px;">{{ $enrollCount }}个学生已被录取</b></span></h4>
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
                //confirmTitle: '确定要操作该学生吗？',
                href: $(this).data('href'),
                successTitle: '操作成功！'
            });
        });
		//完成报名
		$(".registerclose").click(function () {

			swal({   title: "确定要生成录取名单吗?",   text: "生成录取名单后前台会显示录取名单，确定要生成录吗？",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "确定",cancelButtonText: "取消",   closeOnConfirm: false }, function(){
				$.ajax({
					url: "{{ route('admin.register.complete') }}",
					type: "POST"
				}).done(function(data) {
					swal("操作成功!", "已生成录取名单！", "success");
					window.location.reload();
				}).error(function(data) {
					swal("OMG", "操作失败了!", "error");
				});
			});
		});
		//取消报名
		$(".registeropen").click(function () {

			swal({   title: "确定要删除录取名单吗?",   text: "删除录取名单后前台会不显示，确定要删除吗？",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "确定",cancelButtonText: "取消",   closeOnConfirm: false }, function(){
				$.ajax({
					url: "{{ route('admin.register.open') }}",
					type: "POST"
				}).done(function(data) {
					swal("操作成功!", "已删除录取名单！", "success");
					window.location.reload();
				}).error(function(data) {
					swal("OMG", "操作失败了!", "error");
				});
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
					'aTargets':[0,3,4,5,6,9]   //指定的列
				}],
				//order: [[ 1, "asc" ]],
				autoWidth: true,
				language: {
					url: '/assets/language/datatables-zh.json'
				}
			});
		})
	</script>
@endsection