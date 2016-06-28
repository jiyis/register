<div class="panel-body panel-body-nopadding">
    <div class="form-group">
        {!! Form::label('roles', '所属角色组 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('roles[]', $roles, null, ['class' => 'form-control select2', 'multiple'=>'multiple']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('name', '用户名 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('name', old('name'), ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '不可重复']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('nickname', '昵称 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('nickname', old('nickname'), ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('email', '邮箱 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('email', old('email'), ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password', '密码 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::password('password', ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('is_super', '超级管理员',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-2">
            <label class="radio-inline">
                {!! Form::radio('is_super', 1, null,['class' => 'square']) !!} 是
            </label>
            <label class="radio-inline">
                {!! Form::radio('is_super', 0, 1,['class' => 'square']) !!} 否
            </label>

        </div>
    </div>

    {{ csrf_field() }}
</div><!-- panel-body -->

<div class="panel-footer">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <button class="btn bg-purple">保存</button>
            &nbsp;
            <a href="{{ route('admin.users.index') }}" class="btn btn-default">取消</a>
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
