<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{asset('storage')}}/{{ Session::get('avatar')}}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown">{{ Session::get('fullname')}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="button"> keyboard_arrow_down </i>
                <ul class="dropdown-menu slideUp">
                    <li><a href="{{route('profile.index', ['id' => Session::get('user_username')])}}"><i class="material-icons">person</i>Profile</a></li>
                    {{-- <li class="divider"></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li> --}}
                    <li class="divider"></li>
                    <li><a href="{{route('logout')}}"><i class="material-icons">input</i>Sign Out</a></li>
                </ul>
            </div>
            <div class="email">{{ Session::get('email')}}</div>
        </div>
    </div>
    <!-- #User Info --> 
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            @if(Session::get('level') == 1)
            <li ><a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">person</i><span>Tài khoản</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('account.list')}}">Quản lý tài khoản</a></li>
                    <li><a href="blog-dashboard.html">Tài khoản admin</a></li>
                </ul>
            </li>
            <li ><a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">category</i><span>Management</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('chucvu.list')}}">Quản lý chức vụ</a></li>
                    <li><a href="{{route('phongban.list')}}">Quản lý phòng ban</a></li>
                    <li><a href="blog-dashboard.html">Quản lý phụ cấp thân nhân</a></li>
                    <li><a href="blog-dashboard.html">Quản lý phụ cấp khác</a></li>
                    <li><a href="blog-dashboard.html">Quản lý lương</a></li>
                </ul>
            </li>
            @endif
            <li ><a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">description</i><span>Report</span></a>
                <ul class="ml-menu">
                    @if(Session::get('level') == 1)
                        <li><a href="{{route('account.list')}}">Báo cáo lương toàn thể nhân viên</a></li>
                    @endif
                    <li><a href="index2.html">báo cáo lương</a></li>
                    <li><a href="{{route('contact')}}">Danh sách nhân viên</a></li>
                </ul>
            </li>




                </ul>
            </div>
        </div>
    </div>
</aside>