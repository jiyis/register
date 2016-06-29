<table class="table table-responsive"  id="registers-matches">
    <thead>
        <th>
            <span class="ckbox ckbox-primary">
                <input type="checkbox" id="selectall"/>
                <label for="selectall"></label>
            </span>
        </th>
        <th>省份</th>
        <th>性别</th>
        <th>政治面貌</th>
        <th>身高</th>
        <th>录取学院</th>
        <th>毕业中学</th>
        <th>手机号码</th>
        <th>注册时间</th>
        <th>操作</th>
    </thead>
    <tbody>
    @foreach($registers as $register)
        <tr>
            <td>
                <div class="ckbox ckbox-default">
                    <input type="checkbox" name="id" id="id-{{ $register->id }}"
                           value="{{ $register->id }}" class="selectall-item"/>
                    <label for="id-{{ $register->id }}"></label>
                </div>
            </td>
            <td>{!! $register->province !!}</td>
            <td>{!! $register->gender !!}</td>
            <td>{!! $register->politics !!}</td>
            <td>{!! $register->stature !!}</td>
            <td>{!! $register->academy !!}</td>
            <td>{!! $register->profession !!}</td>
            <td>{!! $register->telphone !!}</td>
            <td>{!! $register->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.registers.destroy', $register->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a class="btn btn-white btn-xs" href="{!! route('admin.registers.edit', [$register->id]) !!}"><i class="fa fa-pencil"></i> 编辑</a>
                    {!! Form::button('<i class="fa fa-trash-o"></i> 删除</a>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定要删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
