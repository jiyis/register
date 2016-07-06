<!DOCTYPE HTML>
<html lang="en">
<head>
    <!-- Force latest IE rendering engine or ChromeFrame if installed -->
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="File Upload widget with multiple file selection, drag&amp;drop support and progress bar for jQuery. Supports cross-domain, chunked and resumable file uploads. Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap styles -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/bootstrap.min.css') }}">

    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/blueimp-file-upload/jquery.fileupload.css') }}">
</head>
<body>

<div class="container">
    <h1>导入学生信息到数据库</h1>
    <blockquote>
        <p><h5>需要上传指定格式的excel文件，上传过程中可能会需要一些时间，请等到进度条完成后提示操作！！！</h5></p>
    </blockquote>
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>选择Excel</span>
        <input id="fileupload" type="file" name="files" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
    </span>
    <br>
    <br>
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
</div>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/blueimp-file-upload/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('assets/plugins/blueimp-file-upload/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('assets/plugins/blueimp-file-upload/jquery.fileupload.js') }}"></script>

<script>
    $(function () {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        var url = "{{ route('admin.students.import') }}";
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            add: function (e, data) {
                var fileType = data.files[0].name.split('.').pop(), allowdtypes = 'xls,xlsx';
                if (allowdtypes.indexOf(fileType) < 0) {
                    alert('请选择excel文件!');
                    return false;
                }else {
                    data.submit();
                }

            },
            done: function (e, data) {

                if(data.result.status){
                    parent.location.reload(true);
                    parent.jQuery.fancybox.close();

                }
                else{
                    alert(data.result.msg);
                }

            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });
</script>
</body>
</html>
