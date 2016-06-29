<div class="panel-body">
    <!-- 学号 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('student_id', '学号 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('student_id', old('student_id'), ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '不可重复']) !!}
        </div>
    </div>
    <!-- 姓名 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('name', '姓名 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('name', old('name'), ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover']) !!}
        </div>
    </div>
    <!-- 省份 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('province', '省份 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('province', old('province'), ['class' => 'form-control tooltips','data-toggle' => 'tooltip','data-trigger' => 'hover']) !!}
        </div>
    </div>
    <!-- 性别 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('gender', '性别 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('gender', old('gender'), ['class' => 'form-control tooltips']) !!}
        </div>
    </div>
    <!-- 政治面貌 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('politics', '政治面貌 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('politics', old('politics'), ['class' => 'form-control tooltips']) !!}
        </div>
    </div>
    <!-- 身高 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('stature', '身高 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('stature', old('stature'), ['class' => 'form-control tooltips']) !!}
        </div>
    </div>
    <!-- 录取学院 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('academy', '录取学院 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('academy', old('academy'), ['class' => 'form-control tooltips']) !!}
        </div>
    </div>
    <!-- 录取专业 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('profession', '录取专业 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('profession', old('profession'), ['class' => 'form-control tooltips']) !!}
        </div>
    </div>
    <!-- 毕业中学 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('middleschool', '毕业中学 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('middleschool', old('middleschool'), ['class' => 'form-control tooltips']) !!}
        </div>
    </div>
    <!-- 手机号码 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('telphone', '手机号码 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('telphone', old('telphone'), ['class' => 'form-control tooltips']) !!}
        </div>
    </div>
    <!-- 邮编 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('postcode', '邮编 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('postcode', old('postcode'), ['class' => 'form-control tooltips']) !!}
        </div>
    </div>
    <!-- 家庭住址 字段 -->
    <div class="control-group col-sm-4">
        {!! Form::label('address', '家庭住址 *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('address', old('address'), ['class' => 'form-control tooltips']) !!}
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
            <th style="width: 8%">
                与学生关系
            </th>
            <th style="width: 20%">
                工作单位
            </th>
            <th style="width: 18%">
                职务
            </th>
            <th style="width: 12%">
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
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
        </tr>
        <tr>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
            <td>
                <input class="form-control input-sm" type="text" placeholder="">
            </td>
        </tr>
        </tbody>
    </table>
    </div>

    <!-- 爱好特长 字段 -->
    <div class="control-group col-sm-12">
        {!! Form::label('hobby', '爱好特长 *',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('hobby', old('hobby'), ['class' => 'form-control tooltips', 'maxlength' => '30','size' => '30','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '最多30字',' placeholder' => '最多30字']) !!}
        </div>
    </div>

    <!-- 获奖情况 字段 -->
    <div class="control-group col-sm-12">
        {!! Form::label('reward', '获奖情况 *',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::textarea('reward', old('reward'), ['class' => 'form-control tooltips', 'rows' => '5','maxlength' => '200','data-toggle' => 'tooltip','data-trigger' => 'hover','data-original-title' => '最多200字',' placeholder' => '最多200字']) !!}
        </div>
    </div>

    <!-- 个人自述 字段 -->
    <div class="control-group col-sm-12">
        {!! Form::label('personal', '个人自述 *',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-6">
            <div id="personal" class="register-file" > </div>
            <input type="hidden" name="personal" id="personalval">
        </div>
    </div>

    <!-- 获奖证书 字段 -->
    <div class="control-group col-sm-12">
        {!! Form::label('certificate', '获奖证书 *',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-6">
            <div id="certificate" class="register-file" > </div>
            <input type="hidden" name="certificate" id="personalval">
        </div>
    </div>

    <!-- 获奖证书 字段 -->
    <div class="control-group col-sm-12">
        {!! Form::label('video', '视频文件 *',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-6">
            <div id="video" class="register-file" > </div>
            <input type="hidden" name="video" id="personalval">
        </div>
    </div>
</div><!-- panel-body -->

<div class="panel-footer">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <button class="btn btn-success">保存</button>
            &nbsp;
            <a href="{{ action('HomeController@index') }}" class="btn btn-default">取消</a>
        </div>
    </div>
</div><!-- panel-footer -->

