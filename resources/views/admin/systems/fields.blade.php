
<div class="panel-body panel-body-nopadding">
    <div class="form-group">
        {!! Form::label('register_status', '报名状态 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <label class="radio-inline">
                {!! Form::radio('register_status', 1, null,['class' => 'square']) !!} 开启报名
            </label>
            <label class="radio-inline">
                {!! Form::radio('register_status', 0, 1,['class' => 'square']) !!} 关闭报名
            </label>

        </div>
    </div>
    <div class="form-group">
        {!! Form::label('review_status', '初审状态 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <label class="radio-inline">
                {!! Form::radio('review_status', 1, null,['class' => 'square']) !!} 开启初审
            </label>
            <label class="radio-inline">
                {!! Form::radio('review_status', 0, 1,['class' => 'square']) !!} 结束初审
            </label>

        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6 col-md-offset-2">
            <span style="color: red;">PS:<br>1、关闭报名即为结束录取，学生不可再在进行报名，并且前台会生成录取名单。<br>
            2、开启报名并且开启初审即为学生正常报名，并且初审也进行中。<br>3、开启报名并且关闭初审即为学生无法报名，状态为录取进行中。</span>
        </div>
    </div>

    {{ csrf_field() }}
</div><!-- panel-body -->

<div class="panel-footer">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <button class="btn bg-purple">保存</button>
            &nbsp;
            <a href="{{ route('admin.systems.index') }}" class="btn btn-default">取消</a>
        </div>
    </div>
</div><!-- panel-footer -->
@section('javascript')
    @parent
    <script type="text/javascript">
        $(function(){
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
                checkboxClass: 'icheckbox_square-purple',
                radioClass: 'iradio_square-purple'
            });
        })
    </script>
@endsection
