@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>报名系统</h4></div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-md-offset-3 text-center">
                                @if($register->state == 1)
                                    <h2 class="fast"><i class="fa fa-hand-peace-o"></i> 恭喜您初审成功 </h2>
                                    <p>你提交的苏州科技大学敬文新教育书院报名申请表单已经通过初审啦！请在8月21日7:30—18:00期间保持手机畅通，等待电话面试~~</p>
                                    @elseif($register->state == 2)
                                    <h2 class="fast"><i class="fa fa-smile-o"></i> 恭喜您已被录取 </h2>
                                    <p>你已成功被苏州科技大学敬文新教育书院录取！请注意查收电子邮箱录取通知书。</p>
                                    @else
                                    <h2 class="fast"><i class="fa fa-clock-o"></i> 您已经成功报名 </h2>
                                    <ol class="text-left">
                                        <li>请继续将视频资料上传到邮箱:jw_newedu@126.com,视频格式为mp4、mkv.</li>
                                        <li>8月20日10:00再次登录该报名系统，查询初审结果。</li>
                                    </ol>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
