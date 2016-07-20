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
                                @if(!$register)
                                    <h2 class="fast"><i class="fa fa-stop-circle-o"></i> 对不起，您来晚了 </h2>
                                    <p>苏州科技大学敬文新教育书院报名已经截止啦~~</p>
                                @elseif($register->state == 1)
                                    <h2 class="fast"><i class="fa fa-meh-o"></i> 很遗憾！您未被录取 </h2>
                                    <p></p>
                                @elseif($register->state == 2)
                                    <h2 class="fast"><i class="fa fa-smile-o"></i> 恭喜您已被录取  </h2>
                                    <p>你已成功被苏州科技大学敬文新教育书院录取！请注意查收电子邮箱录取通知书。</p>
                                @else
                                    <h2 class="fast"><i class="fa fa-meh-o"></i> 很遗憾！您未通过初审 </h2>
                                    <p></p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
