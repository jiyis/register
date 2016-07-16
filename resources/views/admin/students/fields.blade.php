@section('css')
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet">
    @parent
@endsection
<div class="panel-body panel-body-nopadding">
    <div class="form-group">
        {!! Form::label('student_id', '考试号 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('student_id', old('student_id'), ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '不可重复']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('name', '姓名 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('name', old('name'), ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '不可重复']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('idcard', '身份证号 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('idcard',old('idcard'),  ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password', '密码 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::password('password', ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('nickname', '照片 *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <div id="userpic" class="register-file dropzone"  required="required"> </div>
            <input type="hidden" name="userpic" id="userpicval">
        </div>
    </div>


    {{ csrf_field() }}
</div><!-- panel-body -->

<div class="panel-footer">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <button class="btn bg-purple">保存</button>
            &nbsp;
            <a href="{{ route('admin.students.index') }}" class="btn btn-default">取消</a>
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
            var userpic = '/';
            @if(isset($user))
                var userpic =  "{{ '/'.$user->userpic }}";
                var student_id = "{{ $user->student_id}}";
            @endif
            Dropzone.autoDiscover = false;//防止报"Dropzone already attached."的错误
            $("#userpic").dropzone({
                url: "{!! route('admin.upload.uploadimage') !!}",
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
                    formData.append("student_id", student_id);
                },
                init: function() {
                    var myDropzone = this;
                    //如果已经上传，显示出来
                    if(userpic != '/'){
                        var mockFile = { name: 'userpic-'+student_id };
                        myDropzone.options.addedfile.call(myDropzone, mockFile);
                        myDropzone.options.thumbnail.call(myDropzone, mockFile, userpic);
                        $('.dz-size').empty();
                        $('.dz-details').addClass('download');
                        $('.dz-image').addClass('download');
                        $('.dz-progress').remove();
                        $('.dz-success-mark').remove();
                        $('.dz-error-mark').remove();
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
