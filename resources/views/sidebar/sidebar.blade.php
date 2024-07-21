
<!-- Sidebar -->

<!-- --------------------- SUPER ADMIN ---------------------------------------------------------------------------------------------------- -->

@if (Auth::user()->hr_user_role=='Admin' || Auth::user()->hr_user_role=='admin')

@if(Session::get('user_id') == 1)
<div class="sidebar" id="sidebar" style="background-color: #5c1111;">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>MAIN</span>
                </li>

                <li class="{{set_active(['home'])}} submenu">
                    <a href="#" class="{{ set_active(['home']) ? 'noti-dot' : '' }}">
                        <i class="la la-dashboard"></i>
                        <span> Dashboard</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['home'])}}" href="{{ route('home') }}">Admin Dashboard</a></li>
                        
                    </ul>
                </li>
                
                    <li class="{{set_active(['all/employee/profile','all/user/permission','all/employee/access','user/log','user/activity'])}} submenu">
                        <a href="#" class="{{ set_active(['all/employee/profile','all/user/permission','all/employee/access','user/log','user/activity']) ? 'noti-dot' : '' }}">
                            <i class="la la-user"></i> <span> User Controller</span> <span class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a class="{{set_active(['all/employee/profile'])}}" href="{{ route('all/employee/profile') }}">All Employee</a></li>
                            <li><a class="{{set_active(['all/user/permission'])}}" href="{{ route('all/user/permission') }}">User Role Permissions</a></li>
                            <li><a class="{{set_active(['all/employee/access'])}}" href="{{ route('all/employee/access') }}">Application Access</a></li>
                            <li><a class="{{set_active(['user/log'])}}" href="{{ route('user/log') }}">User Logs</a></li>
                            <li><a class="{{set_active(['user/activity'])}}" href="{{ route('user/activity') }}">Activity Logs</a></li>
                        </ul>
                    </li>
                <br>
                <li class="menu-title"> <span>HR ADMINISTRATION</span> </li>

                <li class="{{set_active(['attendance/report/page'])}}">
                    <a href="{{ route('attendance/report/page') }}" class="{{ set_active(['attendance/report/page']) ? 'noti-dot' : '' }}">
                        <i class="la la-clock"></i> <span>Attendance Report</span></a>
                </li>

                <li class="{{set_active(['payroll/report/page','payroll/records/page'])}} submenu">
                    <a href="#" class="{{ set_active(['payroll/report/page','payroll/records/page']) ? 'noti-dot' : '' }}">
                        <i class="las la-file-download"></i><span> Payroll </span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['payroll/report/page','generate/payroll'])}}" href="{{ route('payroll/report/page') }}"> Daily Wage Payroll </a></li>
                        <li><a class="{{set_active(['payroll/records/page'])}}" href="{{ route('payroll/records/page') }}"> Payroll Records </a></li>
                    </ul>
                </li>

                <li class="{{set_active(['view/leave/credits'])}}">
                    <a href="{{ route('view/leave/credits') }}" class="{{ set_active(['view/leave/credits']) ? 'noti-dot' : '' }}">
                        <i class="la la-user-plus"></i> <span>Leave Credits </span></a>
                </li>

                <li class="{{set_active(['view/schedules'])}}">
                    <a href="{{ route('view/schedules') }}" class="{{ set_active(['view/schedules']) ? 'noti-dot' : '' }}">
                        <i class="la la-calendar-check"></i> <span>Shift and Schedule</span></a>
                </li>

                <li class="{{set_active(['admin/travel/order','admin/overtime','admin/leave/applications'])}} submenu">
                    <a href="#" class="{{ set_active(['admin/travel/order','admin/overtime','admin/leave/applications']) ? 'noti-dot' : '' }}">
                        <i class="la la-file-text"></i> <span> Approvals</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        
                        <li><a class="{{set_active(['admin/overtime'])}}" href="{{ route('admin/overtime') }}">Overtime
                            <span class="badge badge-pill bg-primary float-right">4</span></a>
                        </li>
                        <li><a class="{{set_active(['admin/leave/applications'])}}" href="{{ route('admin/leave/applications') }}">Leaves Applications
                            <span class="badge badge-pill bg-primary float-right">2</span></a>
                        </li>
                        <li><a class="{{set_active(['admin/travel/order'])}}" href="{{ route('admin/travel/order') }}">Travel Orders
                            <span class="badge badge-pill bg-primary float-right">1</span></a>
                        </li>
                        <li><a class="" href="assets.html">Authority to Travel
                            <span class="badge badge-pill bg-primary float-right"></span></a>
                        </li>
                        
                    </ul>
                </li>

                <li class="">
                    <a href="#" class="">
                        <i class="la la-copy"></i>
                        <span> HR Forms </span> 
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a href="assets.html">Overtime</a></li>
                        <li><a href="assets.html">Leave Form</a></li>
                        <li><a class="{{set_active(['admin/travelorder/form'])}}" href="{{ route('admin/travelorder/form') }}">Travel Order</a></li>
                        <li><a href="assets.html">Authority to Travel</a></li>
                    </ul>
                </li>

                <li class="{{set_active(['view/signatories','view/positions','view/departments','view/designations','view/working/schedule'])}} submenu">
                    <a href="#" class="{{ set_active(['view/signatories','view/positions','view/departments','view/designations','view/working/schedule']) ? 'noti-dot' : '' }}">
                        <i class="la la-list"></i> <span>Item List</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <!-- <li><a class="" href="">Holidays</a></li> -->
                        <li><a class="" href="assets.html">Leaves</a></li>
                        <li><a class="" href="assets.html">Documents / Forms</a></li>
                        <li><a class="{{set_active(['view/signatories'])}}" href="{{ route('view/signatories') }}">Signatories</a></li>
                        <li><a class="{{set_active(['view/positions'])}}" href="{{ route('view/positions') }}">Positions</a></li>
                        <li><a class="{{set_active(['view/departments'])}}" href="{{ route('view/departments') }}">Departments</a></li>                        
                        <li><a class="{{set_active(['view/designations'])}}" href="{{ route('view/designations') }}">Designations</a></li>
                        <li><a class="{{set_active(['view/working/schedule'])}}" href="{{ route('view/working/schedule') }}">Work Schedules</a></li>
                    </ul>
                </li>
                </ul>
        </div>
    </div>
</div>  
<!-- --------------------- END SUPER ADMIN --------------------------------------------------------------------------------------------------- -->
                
<!-- --------------------- ADMIN ---------------------------------------------------------------------------------------------------- -->
@else
@php
    $permissions = session('permissionsArray', []);
@endphp

<div class="sidebar" id="sidebar" style="background-color: #5c1111;">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>MAIN</span>
                </li>

                <li class="{{set_active(['home'])}} submenu">
                    <a href="#" class="{{ set_active(['home']) ? 'noti-dot' : '' }}">
                        <i class="la la-dashboard"></i>
                        <span> Dashboard</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['home'])}}" href="{{ route('home') }}">Admin Dashboard</a></li>
                        
                    </ul>
                </li>
                
                    <li class="{{set_active(['profile_user','home','user/view/dtr'])}} submenu">
                        <a href="{{ route('profile_user') }}" class="{{set_active(['profile_user','home','user/view/dtr']) ? 'noti-dot' : '' }}">
                            <i class="las la-address-card"></i>
                            <span>My Account</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a class="{{set_active(['profile_user','home'])}}" href="{{ route('profile_user') }}"><i class="la la-user"></i>&nbsp; <span>My Profile</span></a></li>
                            <li><a class="{{set_active(['user/view/dtr'])}}" href="{{ route('user/view/dtr') }}"><i class="la la-clock-o"></i>&nbsp; <span> My DTR </span></a></li>
                            <li><a class="" href="leave.html"><i class="las la-chalkboard"></i></i>&nbsp; <span> Leave Credits</span></a></li>
                            <li><a class="" href="leave.html"><i class="las la-envelope-square"></i>&nbsp; <span> My Benefits</span></a></li>
                        </ul>
                    </li>
                <br>
                <li class="menu-title"> <span>HR ADMINISTRATION</span> </li>

                @foreach ($permissions as $id_count => $permission)
                @if ($permission['add'] == 'Y' or $permission['view'] == 'Y' or $permission['update'] == 'Y' or $permission['delete'] == 'Y' or $permission['upload'] == 'Y' or $permission['download'] == 'Y')
                    @if ($id_count == 1)
                    <li class="{{set_active(['all/employee/profile','all/user/permission','all/employee/access','user/log','user/activity'])}} submenu">
                        <a href="#" class="{{ set_active(['all/employee/profile','all/user/permission','all/employee/access','user/log','user/activity']) ? 'noti-dot' : '' }}">
                            <i class="la la-user"></i> <span> User Controller</span> <span class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a class="{{set_active(['all/employee/profile'])}}" href="{{ route('all/employee/profile') }}">All Employee</a></li>
                            <li><a class="{{set_active(['all/user/permission'])}}" href="{{ route('all/user/permission') }}">User Role Permissions</a></li>
                            <li><a class="{{set_active(['all/employee/access'])}}" href="{{ route('all/employee/access') }}">Application Access</a></li>
                            <li><a class="{{set_active(['user/log'])}}" href="{{ route('user/log') }}">User Logs</a></li>
                            <li><a class="{{set_active(['user/activity'])}}" href="{{ route('user/activity') }}">Activity Logs</a></li>
                        </ul>
                    </li>
                @endif
                @if ($id_count == 2)
                <li class="{{set_active(['attendance/report/page'])}}">
                    <a href="{{ route('attendance/report/page') }}" class="{{ set_active(['attendance/report/page']) ? 'noti-dot' : '' }}">
                        <i class="la la-clock"></i> <span>Attendance Report</span></a>
                </li>
                @elseif ($id_count == 3)
                <li class="{{set_active(['payroll/report/page','payroll/records/page'])}} submenu">
                    <a href="#" class="{{ set_active(['payroll/report/page','payroll/records/page']) ? 'noti-dot' : '' }}">
                        <i class="las la-file-download"></i><span> Payroll </span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['payroll/report/page','generate/payroll'])}}" href="{{ route('payroll/report/page') }}"> Daily Wage Payroll </a></li>
                        <li><a class="{{set_active(['payroll/records/page'])}}" href="{{ route('payroll/records/page') }}"> Payroll Records </a></li>
                    </ul>
                </li>
                @elseif ($id_count == 4)
                <li class="{{set_active(['view/leave/credits'])}}">
                    <a href="{{ route('view/leave/credits') }}" class="{{ set_active(['view/leave/credits']) ? 'noti-dot' : '' }}">
                        <i class="la la-user-plus"></i> <span>Leave Credits </span></a>
                </li>
                @elseif ($id_count == 5)
                <li class="{{set_active(['view/schedules'])}}">
                    <a href="{{ route('view/schedules') }}" class="{{ set_active(['view/schedules']) ? 'noti-dot' : '' }}">
                        <i class="la la-calendar-check"></i> <span>Shift and Schedule</span></a>
                </li>
                @elseif ($id_count == 6)
                <li class="{{set_active(['admin/travel/order','admin/overtime','admin/leave/applications'])}} submenu">
                    <a href="#" class="{{ set_active(['admin/travel/order','admin/overtime','admin/leave/applications']) ? 'noti-dot' : '' }}">
                        <i class="la la-file-text"></i> <span> Approvals</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        
                        <li><a class="{{set_active(['admin/overtime'])}}" href="{{ route('admin/overtime') }}">Overtime
                            <span class="badge badge-pill bg-primary float-right">4</span></a>
                        </li>
                        <li><a class="{{set_active(['admin/leave/applications'])}}" href="{{ route('admin/leave/applications') }}">Leaves Applications
                            <span class="badge badge-pill bg-primary float-right">2</span></a>
                        </li>
                        <li><a class="{{set_active(['admin/travel/order'])}}" href="{{ route('admin/travel/order') }}">Travel Orders
                            <span class="badge badge-pill bg-primary float-right">1</span></a>
                        </li>
                        <li><a class="" href="assets.html">Authority to Travel
                            <span class="badge badge-pill bg-primary float-right"></span></a>
                        </li>
                        
                    </ul>
                </li>
                @elseif ($id_count == 7)
                <li class="">
                    <a href="#" class="">
                        <i class="la la-copy"></i>
                        <span> HR Forms </span> 
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a href="assets.html">Overtime</a></li>
                        <li><a href="assets.html">Leave Form</a></li>
                        <li><a class="{{set_active(['admin/travelorder/form'])}}" href="{{ route('admin/travelorder/form') }}">Travel Order</a></li>
                        <li><a href="assets.html">Authority to Travel</a></li>
                    </ul>
                </li>
                @elseif ($id_count == 8)
                <li class="{{set_active(['view/signatories','view/positions','view/departments','view/designations','view/working/schedule'])}} submenu">
                    <a href="#" class="{{ set_active(['view/signatories','view/positions','view/departments','view/designations','view/working/schedule']) ? 'noti-dot' : '' }}">
                        <i class="la la-list"></i> <span>Item List</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <!-- <li><a class="" href="">Holidays</a></li> -->
                        <li><a class="" href="assets.html">Leaves</a></li>
                        <li><a class="" href="assets.html">Documents / Forms</a></li>
                        <li><a class="{{set_active(['view/signatories'])}}" href="{{ route('view/signatories') }}">Signatories</a></li>
                        <li><a class="{{set_active(['view/positions'])}}" href="{{ route('view/positions') }}">Positions</a></li>
                        <li><a class="{{set_active(['view/departments'])}}" href="{{ route('view/departments') }}">Departments</a></li>                        
                        <li><a class="{{set_active(['view/designations'])}}" href="{{ route('view/designations') }}">Designations</a></li>
                        <li><a class="{{set_active(['view/working/schedule'])}}" href="{{ route('view/working/schedule') }}">Work Schedules</a></li>
                    </ul>
                </li>

                @endif
            @endif
        @endforeach
        </ul>
        </div>
    </div>
</div>
    @endif              
@endif
<!-- --------------------- END ADMIN --------------------------------------------------------------------------------------------------- -->

<!-- --------------------- EMPLOYEE ---------------------------------------------------------------------------------------------------- -->
@if (Auth::user()->hr_user_role=='Employee' || Auth::user()->hr_user_role=='employee')
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">
                        <span>MAIN</span>
                    </li>
                    <li class="{{set_active(['profile_user','home','user/view/dtr'])}} submenu">
                        <a href="{{ route('profile_user') }}" class="{{set_active(['profile_user','home','user/view/dtr']) ? 'noti-dot' : '' }}">
                            <i class="las la-address-card"></i>
                            <span>My Account</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a class="{{set_active(['profile_user','home'])}}" href="{{ route('profile_user') }}"><i class="la la-user"></i>&nbsp; <span>My Profile</span></a></li>
                            <li><a class="{{set_active(['user/view/dtr'])}}" href="{{ route('user/view/dtr') }}"><i class="la la-clock-o"></i>&nbsp; <span> My DTR </span></a></li>
                            <li><a class="" href="leave.html"><i class="las la-chalkboard"></i></i>&nbsp; <span> Leave Credits</span></a></li>
                            <li><a class="" href="leave.html"><i class="las la-envelope-square"></i>&nbsp; <span> My Benefits</span></a></li>
                        </ul>
                    </li>
                    <br>
                    <li class="menu-title"> <span>HR FORMS</span> </li>
                    <li class="{{set_active(['user/travel/order'])}} submenu">
                        <a href="#" class="{{set_active(['user/travel/order']) ? 'noti-dot' : '' }}">
                            <i class="la la-edit"></i>
                            <span> Application Forms </span> 
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a href="assets.html">Overtime</a></li>
                            <li><a href="assets.html">Leave Form</a></li>
                            <li><a class="{{set_active(['user/travel/order'])}}" href="{{ route('user/travel/order') }}">Travel Order</a></li>
                            <li><a href="assets.html">Authority to Travel</a></li>
                        </ul>
                    </li>
            
@endif

<!-- --------------------- END EMPLOYEE --------------------------------------------------------------------------------------------------- -->

            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->