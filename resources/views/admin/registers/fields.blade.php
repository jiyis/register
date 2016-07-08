@section('css')
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet">
    @parent
@endsection

<div class="panel-body panel-body-nopadding">
    <!-- 学号 字段 -->
    <div class="form-group col-sm-12">
        {!! Form::label('student_id', '学号 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('student_id', old('student_id'), ['class' => 'form-control tooltips','disabled' => 'disabled']) !!}
        </div>
    </div>
    <!-- 姓名 字段 -->
    <div class="form-group col-sm-12">
        {!! Form::label('name', '姓名 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('name', old('name'), ['class' => 'form-control tooltips','disabled' => 'disabled']) !!}
        </div>
    </div>

    <!-- 邮箱 字段 -->
    <div class="form-group col-sm-12">
        {!! Form::label('name', '邮箱 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::email('email', old('email'), ['class' => 'form-control tooltips']) !!}
        </div>
    </div>

    <!-- Province Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('province', '省份:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('province',  config('common.province'),  old('province'), ['class' => 'form-control tooltips select2', 'placeholder' => '请选择省份']) !!}
        </div>
    </div>

    <!-- Gender Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('gender', '性别:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <label class="radio-inline">
                {!! Form::radio('gender', 1, 1,['class' => 'square']) !!} 男
            </label>
            <label class="radio-inline">
                {!! Form::radio('gender', 0, null,['class' => 'square']) !!} 女
            </label>
        </div>
    </div>

    <!-- Stature Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('stature', '身高:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('stature', $statures, old('stature'), ['class' => 'select2 form-control tooltips', 'placeholder' => '请选择身高']) !!}
        </div>
    </div>

    <!-- Academy Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('academy', '录取学院:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('academy', $academy, old('academy'), ['class' => 'select2 form-control tooltips', 'placeholder' => '请选择学院']) !!}
        </div>
    </div>

    <!-- Middleschool Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('middleschool', '毕业中学:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('middleschool', old('middleschool'), ['class' => 'form-control tooltips']) !!}
        </div>
    </div>

    <!-- Telphone Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('telphone', '手机号码:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('telphone', old('telphone'), ['class' => 'form-control tooltips']) !!}
        </div>
    </div>

    <!-- Postcode Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('postcode', '邮编:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('postcode', old('postcode'), ['class' => 'form-control tooltips']) !!}
        </div>
    </div>

    <!-- Address Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('address', '家庭地址:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('address', old('address'), ['class' => 'form-control tooltips']) !!}
        </div>
    </div>

    <!-- Family Field -->
    <div class="form-group col-sm-12 col-lg-12">
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
                    {!! Form::text('family[name1]', old('family.name1'), ['class' => 'form-control tooltips']) !!}
                </td>
                <td>
                    {!! Form::text('family[age1]', old('family.age1'), ['class' => 'form-control tooltips']) !!}
                </td>
                <td>
                    {!! Form::text('family[relation1]', old('family.relation1'), ['class' => 'form-control tooltips']) !!}
                </td>
                <td>
                    {!! Form::text('family[work1]', old('family.work1'), ['class' => 'form-control tooltips']) !!}
                </td>
                <td>
                    {!! Form::text('family[position1]', old('family.position1'), ['class' => 'form-control tooltips']) !!}
                </td>
                <td>
                    {!! Form::text('family[healthy1]', old('family.healthy1'), ['class' => 'form-control tooltips']) !!}
                </td>
                <td>
                    {!! Form::text('family[tel1]', old('family.tel1'), ['class' => 'form-control tooltips']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    {!! Form::text('family[name2]', old('family.name2'), ['class' => 'form-control tooltips']) !!}
                </td>
                <td>
                    {!! Form::text('family[age2]', old('family.age2'), ['class' => 'form-control tooltips']) !!}
                </td>
                <td>
                    {!! Form::text('family[relation2]', old('family.relation2'), ['class' => 'form-control tooltips']) !!}
                </td>
                <td>
                    {!! Form::text('family[work2]', old('family.work2'), ['class' => 'form-control tooltips']) !!}
                </td>
                <td>
                    {!! Form::text('family[position2]', old('family.position2'), ['class' => 'form-control tooltips']) !!}
                </td>
                <td>
                    {!! Form::text('family[healthy2]', old('family.healthy2'), ['class' => 'form-control tooltips']) !!}
                </td>
                <td>
                    {!! Form::text('family[tel2]', old('family.tel2'), ['class' => 'form-control tooltips']) !!}
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- 申请理由 Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('hobby', '申请理由:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::textarea('reason', old('reason'), ['class' => 'form-control tooltips', 'rows' => '6','maxlength' => '500','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '最多500字',' placeholder' => '最多500字']) !!}
        </div>
    </div>

    <!-- Hobby Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('hobby', '爱好特长:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('hobby', old('hobby'), ['class' => 'form-control tooltips', 'maxlength' => '30','size' => '30','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '最多30字',' placeholder' => '最多30字']) !!}
        </div>
    </div>


    <!-- Reward Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('reward', '获奖情况:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::textarea('reward', old('reward'), ['class' => 'form-control tooltips', 'rows' => '5','maxlength' => '200','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '最多200字',' placeholder' => '最多200字']) !!}
        </div>
        </div>
    </div>


    <!-- Personal Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('personal', '个人自述:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <div id="personal" class="register-file dropzone" > </div>
            <input type="hidden" name="personal" id="personalval">
        </div>
    </div>
    <div class="clearfix"></div>

    <!-- Certificate Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('certificate', '获奖证书:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <div id="certificate" class="register-file dropzone" > </div>
            <input type="hidden" name="certificate" id="certificateval">
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
    <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $(".select2").select2();
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
                checkboxClass: 'icheckbox_square-purple',
                radioClass: 'iradio_square-purple'
            });

            //专业跟学院联动
            /*$('#academy').change(function(){
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
            })*/
            //上传个人自述扫描件
            Dropzone.autoDiscover = false;//防止报"Dropzone already attached."的错误
            var personal =  "{{ '/'.$register->personal }}";
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
                    if(personal != '/'){
                        var mockFile = { name: 'personal-'+"{{ $register->personal}}" };
                        myDropzone.options.addedfile.call(myDropzone, mockFile);
                        myDropzone.options.thumbnail.call(myDropzone, mockFile, personal);
                        $('.dz-details').hide();
                        $('#personalval').val("{{ $register->personal}}");
                    }

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
            var certificate =  "{{ '/'.$register->certificate }}";
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
                    //如果已经上传，显示出来
                    if(certificate != '/'){
                        var mockFile = { name: '点击下载获奖证书' };
                        myDropzone.options.addedfile.call(myDropzone, mockFile);
                        myDropzone.options.thumbnail.call(myDropzone, mockFile, '/assets/images/download.png');
                        $('.dz-size').empty();
                        $('.dz-details').addClass('download');
                        $('.dz-image').addClass('download');
                        $('.dz-progress').remove();
                        $('.dz-success-mark').remove();
                        $('.dz-error-mark').remove();
                        $('#certificateval').val("{{ $register->certificate}}");
                    }
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
            /*var video =  "{{ '/'.$register->video }}";
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
                    //如果已经上传，显示出来
                    if(certificate != '/'){
                        var mockFile = { name: '点击下载视频' };
                        myDropzone.options.addedfile.call(myDropzone, mockFile);
                        myDropzone.options.thumbnail.call(myDropzone, mockFile, '/assets/images/download.png');
                        $('.dz-size').empty();
                        $('.dz-details').addClass('download');
                        $('.dz-image').addClass('download');
                        $('.dz-progress').remove();
                        $('.dz-success-mark').remove();
                        $('.dz-error-mark').remove();
                        $('#videoval').val("{{ $register->video}}");
                    }
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
            })*/

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
            //点击下载
            $('.download').click(function () {
                var id = $(this).parent().parent().attr('id');
                var path = $('#'+id+'val').val();
                var url = "{{ route('admin.download') }}";
                url = url +  '?path=' + path;
                window.location.href = url;
            })
        })
    </script>
@endsection
