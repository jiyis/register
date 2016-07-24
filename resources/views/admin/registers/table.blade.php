<table class="table table-responsive"  id="datatables">
    <thead>
        <th>
            <label>
                <input type="checkbox" class="square" id="selectall">
            </label>
        </th>
        <th>考生号</th>
        <th>姓名</th>
        <th>省份</th>
        <th>性别</th>
        <th>录取学院</th>
        <th>手机号码</th>
        <th>年级</th>
        <th>状态</th>
        <th>操作</th>
    </thead>
    <tbody>
    @foreach($registers as $register)
        <tr>
            <td>
                <label>
                    <input type="checkbox" class="square selectall-item" name="id" id="id-{{ $register->id }}" value="{{ $register->id }}" />
                </label>
            </td>
            <td>{!! $register->student_id !!}</td>
            <td>{!! $register->name !!}</td>
            <td>{!! $register->province !!}</td>
            <td>{!! $register->gender !!}</td>
            <td>{!! $register->academy !!}</td>
            <td>{!! $register->telphone !!}</td>
            <td>{!! substr($register->created_at->format('Y'),-2) !!}届</td>
            <td>@if($register->review_state == 0)
                    <span class="label label-default">未操作</span>
                @elseif($register->review_state == 1)
                    <span class="label label-warning">初审未通过</span>
                @elseif($register->review_state == 2 && $register->register_state == 0)
                    <span class="label label-info">已初审</span>
                @elseif($register->review_state == 2 && $register->register_state == 1)
                    <span class="label label-danger">录取未通过</span>
                @else
                    <span class="label label-success">已录取</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.registers.edit',['id'=>$register->id]) }}"
                   class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>
                <!--<a class="btn btn-danger btn-xs user-delete"
                   data-href="{{ route('admin.registers.destroy',$register->id) }}">
                    <i class="fa fa-trash-o"></i> 删除</a>-->
                {!!  $register->state !!}


                <a class="btn btn-info btn-xs"
                   href="{{ route('admin.registers.export',['id'=>$register->id]) }}">
                    <i class="fa fa-share"></i> 导出</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
