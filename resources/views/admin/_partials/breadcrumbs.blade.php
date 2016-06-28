@if($breadcrumbs)
    <h1>
        {{ $breadcrumbs[1]->title }}中心
        <small></small>
    </h1>
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$breadcrumb->last)
                <li><a href="{{ $breadcrumb->url }}"><i class="fa fa-dashboard"></i>{{ $breadcrumb->title }}</a></li>
            @else
                <li class="active">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ol>
@endif