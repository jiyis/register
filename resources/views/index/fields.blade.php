@section('css')
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet">
    @parent
@endsection
<div class="panel-body">
    <!-- 学号 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('student_id', '学号 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            <input type="text" disabled="disabled" data-original-title="不可修改" data-trigger="hover" data-toggle="tooltip" value="{{  Auth::guard('web')->user()->student_id }}" class="form-control tooltips">
        </div>
    </div>
    <!-- 姓名 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('name', '姓名 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            <input type="text" disabled="disabled" data-original-title="不可修改" data-trigger="hover" data-toggle="tooltip" value="{{  Auth::guard('web')->user()->name }}" class="form-control tooltips">
        </div>
    </div>

    <!-- 邮箱 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('name', '邮箱 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::email('email', old('email'), ['class' => 'form-control tooltips','required' => 'required']) !!}
        </div>
    </div>

    <!-- 省份 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('province', '省份 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::select('province', config('common.province'), old('province'),['class' => 'select2 form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover','required' => 'required', 'placeholder' => '请选择省份']) !!}
        </div>
    </div>

    <!-- 性别 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('gender', '性别 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            <label class="radio-inline">
                {!! Form::radio('gender', 1, 1,['class' => 'square']) !!} 男
            </label>
            <label class="radio-inline">
                {!! Form::radio('gender', 0, null,['class' => 'square']) !!} 女
            </label>
        </div>
    </div>

    <!-- 身高 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('stature', '身高 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::select('stature', $statures, old('stature'), ['class' => 'select2 form-control tooltips','required' => 'required', 'placeholder' => '请选择身高']) !!}
        </div>
    </div>
    <!-- 录取学院 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('academy', '录取学院 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::select('academy', $academy, old('academy'), ['class' => 'select2 form-control tooltips','required' => 'required', 'placeholder' => '请选择学院']) !!}
        </div>
    </div>

    <!-- 毕业中学 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('middleschool', '毕业中学 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('middleschool', old('middleschool'), ['class' => 'form-control tooltips','required' => 'required']) !!}
        </div>
    </div>
    <!-- 手机号码 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('telphone', '手机号码 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('telphone', old('telphone'), ['class' => 'form-control tooltips','required' => 'required', 'placeholder' => '电话面试当天保证通话畅通']) !!}
        </div>
    </div>
    <!-- 邮编 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('postcode', '邮编 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('postcode', old('postcode'), ['class' => 'form-control tooltips','required' => 'required']) !!}
        </div>
    </div>
    <!-- 家庭住址 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('address', '家庭住址 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('address', old('address'), ['class' => 'form-control tooltips','required' => 'required']) !!}
        </div>
    </div>
    <!-- 家庭关系 字段 -->
    <div class="control-group col-sm-12">
        <table class="table  table-bordered table-hover family-table">
        <thead>
        <tr>
            <th colspan="8" class="text-center family-title">家庭成员信息</th>
        </tr>
        <tr>
            <th style="width: 12%">
                姓名
            </th>
            <th style="width: 8%">
                年龄
            </th>
            <th style="width: 10%">
                与学生关系
            </th>
            <th style="width: 20%">
                工作单位
            </th>
            <th style="width: 18%">
                职务
            </th>
            <th style="width: 10%">
                健康状况
            </th>
            <th style="width: 12%">
                手机
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <input name="family[name1]" class="form-control input-sm" value="{{ old('family.name1') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family[age1]" class="form-control input-sm" value="{{ old('family.age1') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family[relation1]" class="form-control input-sm" value="{{ old('family.relation1') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family[work1]" class="form-control input-sm" value="{{ old('family.work1') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family[position1]" class="form-control input-sm" value="{{ old('family.position1') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family[healthy1]" class="form-control input-sm" value="{{ old('family.healthy1') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family[tel1]" class="form-control input-sm" value="{{ old('family.tel1') }}" type="text" placeholder="" required="required">
            </td>
        </tr>
        <tr>
            <td>
                <input name="family[name2]" class="form-control input-sm" value="{{ old('family.name2') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[age2]" class="form-control input-sm" value="{{ old('family.age2') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[relation2]" class="form-control input-sm" value="{{ old('family.relation2') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[work2]" class="form-control input-sm" value="{{ old('family.work2') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[position2]" class="form-control input-sm" value="{{ old('family.position2') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[healthy2]" class="form-control input-sm" value="{{ old('family.healthy2') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[tel2]" class="form-control input-sm" value="{{ old('family.tel2') }}" type="text" placeholder="">
            </td>
        </tr>
        <tr>
            <td>
                <input name="family[name3]" class="form-control input-sm" value="{{ old('family.name3') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[age3]" class="form-control input-sm" value="{{ old('family.age3') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[relation3]" class="form-control input-sm" value="{{ old('family.relation3') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[work3]" class="form-control input-sm" value="{{ old('family.work3') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[position3]" class="form-control input-sm" value="{{ old('family.position3') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[healthy3]" class="form-control input-sm" value="{{ old('family.healthy3') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[tel3]" class="form-control input-sm" value="{{ old('family.tel3') }}" type="text" placeholder="">
            </td>
        </tr>
        <tr>
            <td>
                <input name="family[name4]" class="form-control input-sm" value="{{ old('family.name4') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[age4]" class="form-control input-sm" value="{{ old('family.age4') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[relation4]" class="form-control input-sm" value="{{ old('family.relation4') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[work4]" class="form-control input-sm" value="{{ old('family.work4') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[position4]" class="form-control input-sm" value="{{ old('family.position4') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[healthy4]" class="form-control input-sm" value="{{ old('family.healthy4') }}" type="text" placeholder="">
            </td>
            <td>
                <input name="family[tel4]" class="form-control input-sm" value="{{ old('family.tel4') }}" type="text" placeholder="">
            </td>
        </tr>
        </tbody>
    </table>
    </div>

    <!-- 申请理由 Field -->
    <div class="control-group col-sm-12 col-lg-12">
        {!! Form::label('hobby', '申请理由:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::textarea('reason', old('reason'), ['class' => 'form-control tooltips', 'rows' => '6','maxlength' => '500','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '最多500字',' placeholder' => '最多500字']) !!}
        </div>
    </div>

    <!-- 爱好特长 字段 -->
    <div class="control-group col-sm-12">
        {!! Form::label('hobby', '爱好特长 *',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('hobby', old('hobby'), ['class' => 'form-control tooltips', 'maxlength' => '30','size' => '30','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '最多30字',' placeholder' => '最多30字','required' => 'required']) !!}
        </div>
    </div>

    <!-- 获奖情况 字段 -->
    <div class="control-group col-sm-12">
        <table class="table  table-bordered table-hover reward-table">
            <thead>
            <tr>
                <th colspan="8" class="text-center family-title">获奖情况<span style="color:#c23321; ">（填校级及以上奖项）</span></th>
            </tr>
            <tr>
                <th style="width: 12%">
                    奖项名称
                </th>
                <th style="width: 6%">
                    等第
                </th>
                <th style="width: 8%">
                    获奖时间
                </th>
                <th style="width: 20%">
                    颁发部门
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <input name="reward[name1]" class="form-control input-sm" value="{{ old('reward.name1') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[level1]" class="form-control input-sm" value="{{ old('reward.level1') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[time1]" class="form-control input-sm" value="{{ old('reward.time1') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[deparment1]" class="form-control input-sm" value="{{ old('reward.deparment1') }}" type="text" placeholder="">
                </td>
            </tr>
            <tr>
                <td>
                    <input name="reward[name2]" class="form-control input-sm" value="{{ old('reward.name2') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[level2]" class="form-control input-sm" value="{{ old('reward.level2') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[time2]" class="form-control input-sm" value="{{ old('reward.time2') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[deparment2]" class="form-control input-sm" value="{{ old('reward.deparment2') }}" type="text" placeholder="">
                </td>
            </tr>
            <tr>
                <td>
                    <input name="reward[name3]" class="form-control input-sm" value="{{ old('reward.name3') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[level3]" class="form-control input-sm" value="{{ old('reward.level3') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[time3]" class="form-control input-sm" value="{{ old('reward.time3') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[deparment3]" class="form-control input-sm" value="{{ old('reward.deparment3') }}" type="text" placeholder="">
                </td>
            </tr>
            <tr>
                <td>
                    <input name="reward[name4]" class="form-control input-sm" value="{{ old('reward.name4') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[level4]" class="form-control input-sm" value="{{ old('reward.level4') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[time4]" class="form-control input-sm" value="{{ old('reward.time4') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[deparment4]" class="form-control input-sm" value="{{ old('reward.deparment4') }}" type="text" placeholder="">
                </td>
            </tr>
            <tr>
                <td>
                    <input name="reward[name5]" class="form-control input-sm" value="{{ old('reward.name5') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[level5]" class="form-control input-sm" value="{{ old('reward.level5') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[time5]" class="form-control input-sm" value="{{ old('reward.time5') }}" type="text" placeholder="">
                </td>
                <td>
                    <input name="reward[deparment5]" class="form-control input-sm" value="{{ old('reward.deparment5') }}" type="text" placeholder="">
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- 个人自述 字段 -->
    <div class="control-group col-sm-12">
        <label class="col-sm-2 control-label" for="personal"><span>个人自述 *</span><br><span class="uploadtips">撰写个人申请报告,包括自身成长经历及体会、个性特长及取得的成果、进入高校的努力方向及设想等（须由本人亲笔书写，不超过1000字，用A4纸）</span></label>
        <div class="col-sm-6">
            <div id="personal" class="register-file dropzone"  required="required"> </div>
            <input type="hidden" name="personal" id="personalval">
        </div>
    </div>

    <!-- 获奖证书 字段 -->
    <div class="control-group col-sm-12">
        <label class="col-sm-2 control-label" for="certificate"><span>获奖证书 *</span><br><span class="uploadtips">需要把高中期间获奖证书（不超过五件）扫描或者拍照，打包成压缩包上传。</span></label>
        <div class="col-sm-6">
            <div id="certificate" class="register-file dropzone" required="required" > </div>
            <input type="hidden" name="certificate" id="certificateval">
        </div>
    </div>

</div><!-- panel-body -->

<div class="panel-footer">
    <div class="row">
        <div class="col-sm-3 col-sm-offset-4">
            <button class="btn btn-success">保存</button>
            &nbsp;
            <a href="{{ action('HomeController@index') }}" class="btn btn-default pull-right">取消</a>
        </div>
    </div>
</div><!-- panel-footer -->
@section('javascript')
    @parent
    <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $(".select2").select2();
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
                checkboxClass: 'icheckbox_square-purple',
                radioClass: 'iradio_square-purple'
            });

            //上传个人自述扫描件
            Dropzone.autoDiscover = false;//防止报"Dropzone already attached."的错误
            $("#personal").dropzone({
                url: "{!! route('upload.uploadimage') !!}",
                method: "post",
                addRemoveLinks: true,
                dictDefaultMessage: "点击或者拖拽<br><span style='line-height: 50px;'>文件到这里上传</span>",
                dictCancelUpload: "x",
                dictRemoveFile: '移除文件',
                maxFiles: 1,
                maxFilesize: 5,
                acceptedFiles: "image/*",
                sending: function(file, xhr, formData) {
                    formData.append("_token", $('[name=_token]').val()); // Laravel expect the token post value to be named _token by default
                    formData.append("name", 'personal');
                },
                init: function() {
                    var myDropzone = this;
                    this.on("maxfilesexceeded", function(file) {
                        swal("最多只能上传一个文件，请先移除!");
                        myDropzone.removeFile(file);
                    });
                    this.processQueue();
                    this.on("success", function(file,result) {
                        if(result.code == '0'){
                            swal({title:'上传失败，错误原因：'+result.msg,confirmButtonColor: "#DD6B55"});
                            myDropzone.removeFile(file);
                            return false;
                        }
                        $('#personalval').val(result.path);
                    });
                    this.on("removedfile", function(file) {
                        deleteFile($('#personalval').val());
                    });
                }
            })
            //获奖证书，只能传zip限制
            $("#certificate").dropzone({
                url: "{!! route('upload.uploadfile') !!}",
                method: "post",
                addRemoveLinks: true,
                dictDefaultMessage: "点击或者拖拽<br><span style='line-height: 50px;'>文件到这里上传</span>",
                dictCancelUpload: "x",
                dictRemoveFile: '移除文件',
                maxFiles: 1,
                maxFilesize: 20,
                acceptedFiles: ".rar,.zip,.gz,.7z,.tar.gz",
                sending: function(file, xhr, formData) {
                    formData.append("_token", $('[name=_token]').val()); // Laravel expect the token post value to be named _token by default
                    formData.append("name", 'certificate');
                },
                init: function() {
                    var myDropzone = this;
                    this.on("maxfilesexceeded", function(file) {
                        swal("最多只能上传一个文件，请先移除!");
                        myDropzone.removeFile(file);
                    });
                    this.processQueue();
                    this.on("success", function(file,result) {
                        if(result.code == '0'){
                            swal({title:'上传失败，错误原因：'+result.msg,confirmButtonColor: "#DD6B55"});
                            myDropzone.removeFile(file);
                            return false;
                        }
                        $('#certificateval').val(result.path);
                    });
                    this.on("removedfile", function(file) {
                        deleteFile($('#certificateval').val());
                    });
                }
            })
            //删除文件
            function deleteFile(filename){
                //if(filename == '') swal({title:'文件名不能为空！',confirmButtonColor: "#DD6B55"});
                $.ajax({
                    type: 'POST',
                    url: '{!! route('upload.deletefile') !!}',
                    data: {name: filename},
                    success:function(data) {
                        if(data.code == 0){
                            swal({title:'删除失败，错误原因：'+result.msg,confirmButtonColor: "#DD6B55"});
                            return false;
                        }
                    },
                    dataType: 'json',
                });
            }
        })
    </script>
@endsection

