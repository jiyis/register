<table class="table table-responsive"  id="registers-matches">
    <thead>
        <th>
            <span class="ckbox ckbox-primary">
                <input type="checkbox" id="selectall"/>
                <label for="selectall"></label>
            </span>
        </th>
        <th>Studentid</th>
        <th>Name</th>
        <th>Province</th>
        <th>Gender</th>
        <th>Politics</th>
        <th>Stature</th>
        <th>Academy</th>
        <th>Profession</th>
        <th>Middleschool</th>
        <th>Telphone</th>
        <th>Postcode</th>
        <th>Address</th>
        <th>Family</th>
        <th>Hobby</th>
        <th>Reward</th>
        <th>Personal</th>
        <th>Certificate</th>
        <th>Video</th>
        <th>State</th>
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
            <td>{!! $register->studentID !!}</td>
            <td>{!! $register->name !!}</td>
            <td>{!! $register->province !!}</td>
            <td>{!! $register->gender !!}</td>
            <td>{!! $register->politics !!}</td>
            <td>{!! $register->stature !!}</td>
            <td>{!! $register->academy !!}</td>
            <td>{!! $register->profession !!}</td>
            <td>{!! $register->middleschool !!}</td>
            <td>{!! $register->telphone !!}</td>
            <td>{!! $register->postcode !!}</td>
            <td>{!! $register->address !!}</td>
            <td>{!! $register->family !!}</td>
            <td>{!! $register->hobby !!}</td>
            <td>{!! $register->reward !!}</td>
            <td>{!! $register->personal !!}</td>
            <td>{!! $register->certificate !!}</td>
            <td>{!! $register->video !!}</td>
            <td>{!! $register->state !!}</td>
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
