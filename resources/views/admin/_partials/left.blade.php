    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/assets/images/user.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ $curuser->nickname }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">主要导航</li>
                @inject('commonServices','App\Services\CommonServices')
                @foreach($commonServices::getMenus() as $menu)
                   @if(($menu['name'] !== '#') && !Route::has($menu['name']))
                        @continue
                    @endif
                   <li class="{{ $menu['class'] }} treeview">
                       <a href="{{ $menu['href'] }}">
                           {!! $menu['icon_html'] !!}  <span>{{ $menu['display_name'] }}</span>
                           @if(isset($menu['sub']))
                               <i class="fa fa-angle-left pull-right"></i>
                           @endif
                       </a>
                   @if(!isset($menu['sub']))
                   </li>
                       @continue
                   @endif
                       <ul class="treeview-menu">
                           @foreach($menu['sub'] as $sub)
                           <li class="{{ $sub['class'] }}"><a href="{{ $sub['href'] }}">{!! $sub['icon'] !!}  {{ $sub['display_name'] }}</a></li>
                           @endforeach
                       </ul>
                   </li>

                @endforeach
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
