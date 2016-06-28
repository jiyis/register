<div class="panel-body panel-body-nopadding">
    <div class="form-group">
        <label class="col-sm-3 control-label" for="checkbox">所属权限组</label>
        <div class="col-sm-6">
            {!! Form::select('fid', $topPermissions, null, ['class' => 'form-control select2']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('name', '权限路由 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('name', old('name'), ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '不可重复,不可点击路由输入`#`']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('display_name', '显示名称 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('display_name', old('display_name'), ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('description', '说明 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('description', old('description'), ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover']) !!}
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">图标<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank"><i class="fa fa-info-circle"></i></a></label>

        <div class="col-sm-6">
            {!! Form::text('icon', old('icon'), ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '图标名称,去fa-前缀']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('is_menu', '是否菜单',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-2">
            <label class="radio-inline">
                {!! Form::radio('is_menu', 1, null,['class' => 'square']) !!} 是
            </label>
            <label class="radio-inline">
                {!! Form::radio('is_menu', 0, 1,['class' => 'square']) !!} 否
            </label>

        </div>
    </div>

    <div class="form-group">
        {!! Form::label('sort', '排序 ',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('sort', old('sort'), ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover']) !!}
        </div>
    </div>

    {{ csrf_field() }}
</div><!-- panel-body -->

<div class="panel-footer">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <button class="btn bg-purple">保存</button>
            &nbsp;
            <a href="{{ route('admin.permission.index') }}" class="btn btn-default">取消</a>
        </div>
    </div>
</div><!-- panel-footer -->

@section('javascript')
    @parent
    <script type="text/javascript">
        $(function(){
            $(".select2").select2();
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
                checkboxClass: 'icheckbox_square-purple',
                radioClass: 'iradio_square-purple'
            });
        })
    </script>
@endsection
