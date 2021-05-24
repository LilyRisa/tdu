<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        {{-- <div class="image">
            <img src="{{asset('storage')}}/{{ Session::get('avatar')}}" width="48" height="48" alt="User" />
        </div> --}}
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
                    <li><a href="{{route('phucap.list')}}">Quản lý phụ cấp thân nhân</a></li>
                    <li><a href="{{route('phucapother.list')}}">Quản lý phụ cấp khác</a></li>
                    <li><a href="{{route('salaries.list')}}">Quản lý lương</a></li>
                </ul>
            </li>
            @endif
            <li ><a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">description</i><span>Report</span></a>
                <ul class="ml-menu">
                    @if(Session::get('level') == 1)
                        <li><a href="{{route('account.list')}}">Báo cáo lương toàn thể nhân viên</a></li>
                        <li><a href="{{route('salaryreport.index')}}">Tính lương cho nhân viên</a></li>
                    @endif
                    <li><a href="calendar.list">báo cáo lương</a></li>
                    <li><a href="{{route('calendar.list')}}">Danh sách note</a></li>
                    <li><a href="{{route('contact')}}">Danh sách nhân viên</a></li>
                </ul>
            </li>
            <li ><a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">question_answer</i><span>Exam</span></a>
                <ul class="ml-menu">
                    @if(Session::get('level') == 1)
                        <li><a href="{{route('examinfo.index')}}">Câu hỏi kiểm tra</a></li>
                    @endif
                    <li><a href="{{route('student.index')}}">Tham gia kiểm tra</a></li>
                    <li><a href="{{route('result.index')}}">Kết quả</a></li>
                </ul>
            </li>
            <li ><a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">supervised_user_circle</i><span>Nhận diện khuôn mặt</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('face.index')}}">Nhận diện khuôn mặt</a></li>
                </ul>
            </li>




                </ul>
            </div>
        </div>
    </div>
</aside>

<!-- Right Sidebar -->
<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#skins">Skins</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings">Setting</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane in active in active slideRight" id="skins">
            <div class="slim_scroll">
                <h6>Flat Color</h6>
                <ul class="choose-skin">                   
                    <li data-theme="purple"><div class="purple"></div><span>Purple</span></li>
                    <li data-theme="blue"><div class="blue"></div><span>Blue</span></li>
                    <li data-theme="cyan"><div class="cyan"></div><span>Cyan</span></li>
                </ul>                    
                <h6>Multi Color</h6>
                <ul class="choose-skin">                        
                    <li data-theme="black"><div class="black"></div><span>Black</span></li>
                    <li data-theme="deep-purple"><div class="deep-purple"></div><span>Deep Purple</span></li>
                    <li data-theme="red"><div class="red"></div><span>Red</span></li>
                </ul>                    
                <h6>Gradient Color</h6>
                <ul class="choose-skin">
                    <li data-theme="green"><div class="green"></div><span>Green</span> </li>
                    <li data-theme="orange" class="active"><div class="orange"></div><span>Orange</span></li>
                    <li data-theme="blush"><div class="blush"></div><span>Blush</span></li>
                </ul>
            </div>                
        </div>
        
        <div role="tabpanel" class="tab-pane slideLeft" id="settings">
            <div class="settings slim_scroll">
                <p class="text-left">General Settings</p>
                <ul class="setting-list">
                    <li><span>Report Panel Usage</span>
                        <div class="switch">
                            <label><input type="checkbox" checked><span class="lever"></span></label>
                        </div>
                    </li>
                    <li><span>Email Redirect</span>
                        <div class="switch">
                            <label><input type="checkbox"><span class="lever"></span></label>
                        </div>
                    </li>
                </ul>
                <p class="text-left">System Settings</p>
                <ul class="setting-list">
                    <li><span>Notifications</span>
                        <div class="switch">
                            <label><input type="checkbox" checked><span class="lever"></span></label>
                        </div>
                    </li>
                    <li><span>Auto Updates</span>
                        <div class="switch">
                            <label><input type="checkbox" checked><span class="lever"></span></label>
                        </div>
                    </li>
                </ul>
                <p class="text-left">Account Settings</p>
                <ul class="setting-list">
                    <li><span>Offline</span>
                        <div class="switch">
                            <label><input type="checkbox"><span class="lever"></span></label>
                        </div>
                    </li>
                    <li><span>Location Permission</span>
                        <div class="switch">
                            <label><input type="checkbox" checked><span class="lever"></span></label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>