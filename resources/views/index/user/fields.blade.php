@section('css')
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet">
    @parent
@endsection
<div class="panel-body panel-body-nopadding">
    <div class="form-group">
        {!! Form::label('name', '考生号 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <input type="text" disabled="disabled" data-original-title="不可修改" data-trigger="hover" data-toggle="tooltip" value="{{  $user->student_id }}" class="form-control tooltips">
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('nickname', '姓名 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <input type="text" disabled="disabled" data-original-title="不可修改" data-trigger="hover" data-toggle="tooltip" value="{{  $user->name }}" class="form-control tooltips">
        </div>
    </div>



    <div class="form-group">
        {!! Form::label('password', '密码 ',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::password('password', ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover','placeholder' => '不输入则不修改密码']) !!}
        </div>
    </div>

    <div class="control-group">
        <label class="col-sm-3 control-label" for="userpic">个人照片 *<br><span class="uploadtips">请上传正面免冠证件片，125*165尺寸左右，否则会出现照片残缺。</span></label>
        <div class="col-sm-6">
            <div id="userpic" class="register-file dropzone"  required="required"> </div>
            <input type="hidden" name="userpic" id="userpicval">
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
            //上传个人照片
            var userpic =  "{{ $user->userpic }}";
            Dropzone.autoDiscover = false;//防止报"Dropzone already attached."的错误
            $("#userpic").dropzone({
                url: "{!! route('upload.uploadimage') !!}",
                method: "post",
                addRemoveLinks: true,
                dictDefaultMessage: "点击或者拖拽<br><span style='line-height: 50px;'>照片到这里上传</span>",
                dictCancelUpload: "x",
                dictRemoveFile: '移除文件',
                maxFiles: 1,
                maxFilesize: 5,
                acceptedFiles: "image/*",
                sending: function(file, xhr, formData) {
                    formData.append("_token", $('[name=_token]').val()); // Laravel expect the token post value to be named _token by default
                    formData.append("name", 'userpic');
                },
                init: function() {
                    var myDropzone = this;
                    //如果已经上传，显示出来
                    if(userpic != ''){
                        var mockFile = { name: 'userpic-'+"{{ $user->student_id}}" };
                        myDropzone.options.addedfile.call(myDropzone, mockFile);
                        myDropzone.options.thumbnail.call(myDropzone, mockFile, '/'+userpic);
                        $('.dz-details').hide();
                        $('#userpicval').val(userpic);
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
                        $('#userpicval').val(result.path);
                    });
                    this.on("removedfile", function(file) {
                        deleteFile($('#userpicval').val());
                    });
                }
            })

        })
    </script>
@endsection
