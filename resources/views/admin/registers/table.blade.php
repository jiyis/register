<table class="table table-responsive"  id="datatables">
    <thead>
        <th>
            <label>
                <input type="checkbox" class="square" id="selectall">
            </label>
        </th>
        <th>学号</th>
        <th>姓名</th>
        <th>省份</th>
        <th>性别</th>
        <th>政治面貌</th>
        <th>身高</th>
        <th>录取学院</th>
        <th>录取专业</th>
        <th>手机号码</th>
        <th>注册时间</th>
        <th>操作</th>
    </thead>
    <tbody>
    @foreach($registers as $register)
        <tr>
            <td>
                <label>
                    <input type="checkbox" class="square selectall-item" name="id" id="id-{{ $register->user_id }}" value="{{ $register->user_id }}" />
                </label>
            </td>
            <td>{!! $register->student_id !!}</td>
            <td>{!! $register->name !!}</td>
            <td>{!! $register->province !!}</td>
            <td>{!! $register->gender !!}</td>
            <td>{!! $register->politics !!}</td>
            <td>{!! $register->stature !!}</td>
            <td>{!! $register->academy !!}</td>
            <td>{!! $register->profession !!}</td>
            <td>{!! $register->telphone !!}</td>
            <td>{!! $register->created_at !!}</td>
            <td>
                <a href="{{ route('admin.registers.edit',['user_id'=>$register->user_id]) }}"
                   class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>
                <a class="btn btn-danger btn-xs user-delete"
                   data-href="{{ route('admin.registers.destroy',$register->user_id) }}">
                    <i class="fa fa-trash-o"></i> 删除</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
