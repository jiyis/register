@section('css')
    @parent
    <link href="{{ asset('assets/plugins/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection

<div class="panel-body panel-body-nopadding">
	<!-- Studentid Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('studentID', '考生号:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('studentID', null, ['class' => 'form-control tooltips']) !!}
        </div>
    </div>

    <!-- Name Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('name', '姓名:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('name', null, ['class' => 'form-control tooltips']) !!}
        </div>
    </div>

    <!-- Province Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('province', '省份:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('province', ['Type1' => 'Type1', 'Type2' => 'Type2', 'Type3' => 'Type3', 'Type4' => 'Type4'], null, ['class' => 'form-control tooltips select2', 'multiple'=>'multiple']) !!}
        </div>
    </div>

    <!-- Gender Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('gender', '性别:',['class'=>'col-sm-3 control-label']) !!}
        <label class="radio-inline">
            {!! Form::radio('gender', "1", null,['class' => 'square']) !!} 男
        </label>
        <label class="radio-inline">
            {!! Form::radio('gender', "0", null,['class' => 'square']) !!} 女
        </label>
    </div>

    <!-- Politics Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('politics', '政治面貌:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('politics', ['Type1' => 'Type1', 'Type2' => 'Type2', 'Type3' => 'Type3', 'Type4' => 'Type4'], null, ['class' => 'form-control tooltips select2', 'multiple'=>'multiple']) !!}
        </div>
    </div>

    <!-- Stature Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('stature', '身高:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('stature', ['Type1' => 'Type1', 'Type2' => 'Type2', 'Type3' => 'Type3', 'Type4' => 'Type4'], null, ['class' => 'form-control tooltips select2', 'multiple'=>'multiple']) !!}
        </div>
    </div>

    <!-- Academy Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('academy', '录取学院:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('academy', ['Type1' => 'Type1', 'Type2' => 'Type2', 'Type3' => 'Type3', 'Type4' => 'Type4'], null, ['class' => 'form-control tooltips select2', 'multiple'=>'multiple']) !!}
        </div>
    </div>

    <!-- Profession Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('profession', '录取专业:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('profession', ['Type1' => 'Type1', 'Type2' => 'Type2', 'Type3' => 'Type3', 'Type4' => 'Type4'], null, ['class' => 'form-control tooltips select2', 'multiple'=>'multiple']) !!}
        </div>
    </div>

    <!-- Middleschool Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('middleschool', '毕业中学:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('middleschool', null, ['class' => 'form-control tooltips']) !!}
        </div>
    </div>

    <!-- Telphone Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('telphone', '手机号码:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('telphone', null, ['class' => 'form-control tooltips']) !!}
        </div>
    </div>

    <!-- Postcode Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('postcode', '邮编:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('postcode', null, ['class' => 'form-control tooltips']) !!}
        </div>
    </div>

    <!-- Address Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('address', '家庭地址:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('address', null, ['class' => 'form-control tooltips']) !!}
        </div>
    </div>

    <!-- Family Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('family', '家庭成员:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::textarea('family', null, ['class' => 'form-control init-ueditor', 'rows' => '5']) !!}
        </div>
    </div>


    <!-- Hobby Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('hobby', '爱好特长:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::textarea('hobby', null, ['class' => 'form-control init-ueditor', 'rows' => '5']) !!}
        </div>
    </div>


    <!-- Reward Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('reward', '获奖情况:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::textarea('reward', null, ['class' => 'form-control init-ueditor', 'rows' => '5']) !!}
        </div>
    </div>


    <!-- Personal Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('personal', '个人自述:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <div id="personal" class="uploadpic" > </div>
            <input type="hidden" name="personal">
        </div>
    </div>
    <div class="clearfix"></div>

    <!-- Certificate Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('certificate', '获奖证书:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <div id="certificate" class="uploadpic" > </div>
            <input type="hidden" name="certificate">
        </div>
    </div>
    <div class="clearfix"></div>

    <!-- Video Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('video', '视频文件:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <div id="video" class="uploadpic" > </div>
            <input type="hidden" name="video">
        </div>
    </div>
    <div class="clearfix"></div>

    <!-- State Field -->
    <div class="form-group col-sm-12 hidden">
        {!! Form::label('state', '状态:',['class'=>'col-sm-3 control-label']) !!}
        <label class="radio-inline">
            {!! Form::radio('state', "正常", 1,['class' => 'square']) !!} 正常
        </label>
        <label class="radio-inline">
            {!! Form::radio('state', "拉黑", null,['class' => 'square']) !!} 拉黑
        </label>
    </div>
</div>
<!-- Submit Field -->
<div class="panel-footer">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <button class="btn bg-purple">保存</button>
            &nbsp;
            <a href="{!! route('admin.registers.index') !!}" class="btn btn-default">取消</a>
        </div>
    </div>
</div>
@section('javascript')
    @parent
    @include('UEditor::head')
    <script src="{{ asset('assets/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        //初始化日期插件
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii',language: 'zh-CN'});
        $(".select2").select2();
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
            checkboxClass: 'icheckbox_square-purple',
            radioClass: 'iradio_square-purple'
        });
        var ueditor = UE.getEditor('ueditor', {
            initialFrameHeight: 320,
            autoHeightEnabled: true,
            autoFloatEnabled: true,
            autoFloatEnabled : false,
        });
        ueditor.ready(function(){
            //因为Laravel有防csrf防伪造攻击的处理所以加上此行
            ueditor.execCommand('serverparam','_token','{{ csrf_token() }}');
        });
        $("#attachment").dropzone({
            url: "{!! route('admin.upload.uploadfile') !!}",
            method: "post",
            addRemoveLinks: true,
            dictRemoveLinks: "x",
            maxFiles: 1,
            maxFilesize: 5,
            acceptedFiles: "image/*",
            sending: function(file, xhr, formData) {
                formData.append("_token", $('[name=_token').val());
            },
            init: function() {
                this.on("success", function(file,result) {
                    $('#btitlepicval').val(result.path);
                });
                this.on("removedfile", function(file) {
                    console.log("上传头像失败");
                });
            }
        })
    </script>
@endsection
