<div class="col-sm-3 col-lg-2">
    <ul class="nav nav-pills nav-stacked nav-email">
        <li class="{!! ($curRoutes[1] == 'users') ? 'active' : '' !!}">
            <a href="{{ route('admin.users.index') }}">
                <span class="badge pull-right"></span>
                <i class="fa fa-user"></i> 用户管理
            </a>
        </li>
        <li class="{!! ($curRoutes[1] == 'role') ? 'active' : '' !!}">
            <a href="{{ route('admin.role.index') }}">
                <span class="badge pull-right"></span>
                <i class="fa fa-users"></i> 角色管理
            </a>
        </li>
        <li class="{!! ($curRoutes[1] == 'permission') ? 'active' : '' !!}">
            <a href="{{ route('admin.permission.index') }}">
                <span class="badge pull-right"></span>
                <i class="fa fa-key"></i> 权限管理
            </a>
        </li>
    </ul>
</div><!-- col-sm-3 -->