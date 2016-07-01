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
    <!-- 省份 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('province', '省份 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::select('province', config('common.province'), old('province'),['class' => 'select2 form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover','required' => 'required', 'placeholder' => '请选择省份']) !!}
        </div>
    </div>
    <!-- 政治面貌 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('politics', '政治面貌 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::select('politics', config('common.politics') , old('politics'), ['class' => 'select2 form-control tooltips','required' => 'required', 'placeholder' => '请选择政治面貌']) !!}
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
    <!-- 录取专业 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('profession', '录取专业 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::select('profession', [], old('profession'), ['class' => 'select2 form-control tooltips','required' => 'required', 'placeholder' => '请先选择学院']) !!}
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
            {!! Form::text('telphone', old('telphone'), ['class' => 'form-control tooltips','required' => 'required']) !!}
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
                年收入(万元)
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
                <input name="family['name1']" class="form-control input-sm" value="{{ old('family.name1') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['age1']" class="form-control input-sm" value="{{ old('family.age1') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['relation1']" class="form-control input-sm" value="{{ old('family.relation1') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['work1']" class="form-control input-sm" value="{{ old('family.work1') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['position1']" class="form-control input-sm" value="{{ old('family.position1') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['salary1']" class="form-control input-sm" value="{{ old('family.salary1') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['healthy1']" class="form-control input-sm" value="{{ old('family.healthy1') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['tel1']" class="form-control input-sm" value="{{ old('family.tel1') }}" type="text" placeholder="" required="required">
            </td>
        </tr>
        <tr>
            <td>
                <input name="family['name2']" class="form-control input-sm" value="{{ old('family.name2') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['age2']" class="form-control input-sm" value="{{ old('family.age2') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['relation2']" class="form-control input-sm" value="{{ old('family.relation2') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['work2']" class="form-control input-sm" value="{{ old('family.work2') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['position2']" class="form-control input-sm" value="{{ old('family.position2') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['salary2']" class="form-control input-sm" value="{{ old('family.salary2') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['healthy2']" class="form-control input-sm" value="{{ old('family.healthy2') }}" type="text" placeholder="" required="required">
            </td>
            <td>
                <input name="family['tel2']" class="form-control input-sm" value="{{ old('family.tel2') }}" type="text" placeholder="" required="required">
            </td>
        </tr>
        </tbody>
    </table>
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
        {!! Form::label('reward', '获奖情况 *',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::textarea('reward', old('reward'), ['class' => 'form-control tooltips', 'rows' => '5','maxlength' => '200','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '最多200字',' placeholder' => '最多200字','required' => 'required']) !!}
        </div>
    </div>

    <!-- 个人自述 字段 -->
    <div class="control-group col-sm-12">
        <label class="col-sm-2 control-label" for="personal"><span>个人自述 *</span><br><span class="uploadtips">需要本人手写，然后扫描成图片上传。</span></label>
        <div class="col-sm-6">
            <div id="personal" class="register-file dropzone"  required="required"> </div>
            <input type="hidden" name="personal" id="personalval">
        </div>
    </div>

    <!-- 获奖证书 字段 -->
    <div class="control-group col-sm-12">
        <label class="col-sm-2 control-label" for="certificate"><span>获奖证书 *</span><br><span class="uploadtips">需要把所有的获奖证书扫描或者拍照，打包成压缩包上传。</span></label>
        <div class="col-sm-6">
            <div id="certificate" class="register-file dropzone" required="required" > </div>
            <input type="hidden" name="certificate" id="certificateval">
        </div>
    </div>

    <!-- 视频文件 字段 -->
    <div class="control-group col-sm-12">
        <label class="col-sm-2 control-label" for="video"><span>视频文件 *</span><br><span class="uploadtips">最大上传200M。</span></label>
        <div class="col-sm-6">
            <div id="video" class="register-file dropzone" required="required" ></div>
            <input type="hidden" name="video" id="videoval">
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
            if($('#academy').val() != ''){
                $.ajax({
                    type: 'GET',
                    url: '{{ url("home/getAcademy") }}',
                    data: {academy: $('#academy').val()},
                    success:function(data) {
                        $.each(data, function(key, value) {
                            $('#profession').append($("<option></option>")
                                    .attr("value",key)
                                    .text(value));
                        });
                    },
                    dataType: 'json',
                });
            }
            //专业跟学院联动
            $('#academy').change(function(){
                $('#profession').empty();
                $.ajax({
                    type: 'GET',
                    url: '{{ url("home/getAcademy") }}',
                    data: {academy: $('#academy').val()},
                    success:function(data) {
                        $.each(data, function(key, value) {
                            $('#profession').append($("<option></option>")
                                            .attr("value",key)
                                            .text(value));
                        });
                    },
                    dataType: 'json',
                });
            })
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
            //视频文件，只能传zip限制
            $("#video").dropzone({
                url: "{!! route('upload.uploadfile') !!}",
                method: "post",
                addRemoveLinks: true,
                dictDefaultMessage: "点击或者拖拽<br><span style='line-height: 50px;'>文件到这里上传</span>",
                dictCancelUpload: "x",
                dictRemoveFile: '移除文件',
                maxFiles: 1,
                maxFilesize: 200,
                acceptedFiles: "video/*",
                sending: function(file, xhr, formData) {
                    formData.append("_token", $('[name=_token]').val()); // Laravel expect the token post value to be named _token by default
                    formData.append("name", 'video');
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
                        $('#videoval').val(result.path);
                    });
                    this.on("removedfile", function(file) {
                        deleteFile($('#videoval').val());
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

