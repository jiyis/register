@extends('admin.layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        {!! Breadcrumbs::render('admin-home-index') !!}
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-md-offset-3">
                <h2 class="fast text-left"><i class="fa fa-hand-peace-o"></i> 欢迎使用苏州科技大学敬文书院报名系统 </h2>
                <div class="span5 text-right" style="padding: 3px 0 20px;">
                    <h5>Created At Jul, 2016</h5>
                </div>
                <ul class="lead">
                    <li><h4>本系统是由Laravel5.2+Bootstrap3.3+AdminLte2+Laravel Generator开发而成！</h4></li>
                    <li><h4>本系统是针对苏州科技大学敬文书院的报名系统而开发。</h4></li>
                    <li><h4>如您有如何疑问，请联系苏州科技大学敬文书院管理处。</h4></li>
                    <li><h4>技术支持：Gary.P.Dong.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Email：<a href="mailto:425995717@qq.com">425995717@qq.com</a></h4></li>
                </ul>
            </div>
        </div>
        <!-- /.row -->
        <div class="row" style="min-height: 560px;">

        </div>
    </section>
    <!-- /.content -->
</div>
@endsection