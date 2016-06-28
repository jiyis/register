@extends('admin.layouts.admin')

@section('content')
    @include('admin.registers.show_fields')

    <div class="form-group">
           <a href="{!! route('admin.registers.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
