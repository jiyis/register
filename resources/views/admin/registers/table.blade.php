<table class="table table-responsive"  id="registers-matches">
    <thead>
        <th>
            <label>
                <input type="checkbox" class="square" id="selectall">
            </label>
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
                <label>
                    <input type="checkbox" class="square selectall-item" name="id" id="id-{{ $register->id }}" value="{{ $register->id }}" />
                </label>
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
@section('javascript')
    @parent
    <script type="text/javascript">
        $(function(){

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].square, input[type="radio"].square').iCheck({
                checkboxClass: 'icheckbox_square-purple',
                radioClass: 'iradio_square-purple'
            });
        })
        $(".user-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除用户?',
                href: $(this).data('href'),
                successTitle: '用户删除成功'
            });
        });

        $(".deleteall").click(function () {
            Rbac.ajax.deleteAll({
                confirmTitle: '确定删除选中的用户?',
                href: $(this).data('href'),
                successTitle: '用户删除成功'
            });
        });
    </script>

@endsection
