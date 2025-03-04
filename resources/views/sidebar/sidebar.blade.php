
<!-- Sidebar -->

<!-- --------------------- SUPER ADMIN ---------------------------------------------------------------------------------------------------- -->

@if (Auth::user()->hr_user_role=='Super Admin')

<div class="sidebar" id="sidebar" style="background-color: #01371d;">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>MAIN</span>
                </li>

                <li class="{{set_active(['home'])}} submenu">
                    <a href="#" class="{{ set_active(['home'])}}">
                        <i class="la la-dashboard"></i>
                        <span> Dashboard</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['home'])}}" href="{{ route('home') }}">Admin Dashboard</a></li>
                        
                    </ul>
                </li>
                
                    <li class="{{set_active(['all/employee/profile','all/user/permission','all/user/evaluator','all/employee/access','user/log','user/activity'])}} submenu">
                        <a href="#" class="{{ set_active(['all/employee/profile','all/user/permission','all/user/evaluator','all/employee/access','user/log','user/activity'])}}">
                            <i class="la la-user"></i> <span> User Controller</span> <span class="menu-arrow"></span>
                        </a>
                        <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                            <li><a class="{{set_active(['all/employee/profile'])}}" href="{{ route('all/employee/profile') }}">All Users</a></li>
                            <!-- <li><a class="{{set_active(['all/user/permission'])}}" href="{{ route('all/user/permission') }}">User Admin</a></li> -->
                            <li><a class="{{set_active(['all/user/evaluator'])}}" href="{{ route('all/user/evaluator') }}">Evaluator</a></li>
                            <li><a class="{{set_active(['user/log'])}}" href="{{ route('user/log') }}">User Logs</a></li>
                            <li><a class="{{set_active(['user/activity'])}}" href="{{ route('user/activity') }}">Activity Logs</a></li>
                        </ul>
                    </li>
                <br>
                <li class="menu-title"> <span>ASSESSMENT</span> </li>

                <li class="{{set_active(['elementary/applicants','nonteaching/applicants'])}} submenu">
                    <a href="#" class="{{ set_active(['elementary/applicants','nonteaching/applicants'])}}">
                        <i class="la la-user-plus"></i> <span>New Applicants</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['elementary/applicants'])}}" href="{{ route('elementary/applicants') }}">SPET Applicants</a></li>
                        <!-- <li><a class="" href="#">Elementary Applicants</a></li>
                        <li><a class="" href="#">JHS Applicants</a></li>
                        <li><a class="" href="#">SHS Applicants</a></li>
                        <li><a class="" href="#">Non-Teaching</a></li> -->
                    </ul>
                </li>
                <li class="{{set_active(['view/all/applicants/rating'])}}">
                    <a href="{{ route('view/all/applicants/rating') }}" class="{{ set_active(['view/all/applicants/rating'])}}">
                        <i class="la la-chalkboard"></i>  <span>Ratings</span></span>
                    </a>
                </li>
                <br>
                <li class="menu-title"> <span>ADMINISTRATION</span> </li>

                <li class="{{set_active(['elementary/applicants/done/assessment'])}} submenu">
                    <a href="#" class="{{ set_active(['elementary/applicants/done/assessment'])}}">
                        <i class="la la-id-card"></i> <span>Applicants (Teaching)</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                    <li><a class="{{set_active(['elementary/applicants/done/assessment'])}}" href="{{ route('elementary/applicants/done/assessment') }}">SPET Applicants</a></li>
                        <!-- <li><a class="" href="#">JHS Applicants</a></li>
                        <li><a class="" href="#">SHS Applicants</a></li> -->
                    </ul>
                </li>
                <!-- <li class="{{ set_active(['#'])}}">
                    <a href="#" class="{{ set_active(['#'])}}">
                        <i class="la la-id-card"></i>  <span>Applicants (Non-Teaching)</span>
                    </a>
                </li> -->
                <!-- <li class="">
                    <a href="#" class="{{ set_active(['elementary/applicants'])}}">
                        <i class="la la-chalkboard"></i>  <span>Promotion</span></span>
                    </a>
                </li>
                <li class="">
                    <a href="#" class="{{ set_active(['elementary/applicants'])}}">
                        <i class="la la-external-link-square"></i>  <span>Transfer</span></span>
                    </a>
                </li> -->

                <li class="{{set_active(['view/criteria/spet','view/job/positions'])}} submenu">
                    <a href="#" class="{{ set_active(['view/criteria/spet','view/job/positions'])}}">
                        <i class="la la-list"></i> <span>Item List</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['view/criteria/spet'])}}" href="{{ route('view/criteria/spet') }}">Criteria SPET</a></li>
                        <!-- <li><a class="{{set_active(['view/job/positions'])}}" href="{{ route('view/job/positions') }}">Job Positions</a></li>
                        
                        <li><a class="" href="#">Signatories</a></li>
                        <li><a class="" href="#">Positions</a></li>
                        <li><a class="" href="#">Departments</a></li>                        
                        <li><a class="" href="#">Designations</a></li> -->
                    </ul>
                </li>
                <li class="{{set_active(['database/management'])}} submenu">
                    <a href="#" class="{{ set_active(['database/management'])}}">
                        <i class="la la-list"></i> <span>Reports</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['database/management'])}}" href="{{ route('database/management') }}">Excel File</a></li>
                        <!-- <li><a class="{{set_active(['view/job/positions'])}}" href="{{ route('view/job/positions') }}">Job Positions</a></li>
                        
                        <li><a class="" href="#">Signatories</a></li>
                        <li><a class="" href="#">Positions</a></li>
                        <li><a class="" href="#">Departments</a></li>                        
                        <li><a class="" href="#">Designations</a></li> -->
                    </ul>
                </li>
                </ul>
        </div>
    </div>
</div>  
<!-- --------------------- END SUPER ADMIN --------------------------------------------------------------------------------------------------- -->

<!-- --------------------- DATA ADMIN ---------------------------------------------------------------------------------------------------- -->

@elseif (Auth::user()->hr_user_role=='Data Admin')

<div class="sidebar" id="sidebar" style="background-color: #01371d;">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>MAIN</span>
                </li>

                <li class="{{set_active(['home'])}} submenu">
                    <a href="#" class="{{ set_active(['home'])}}">
                        <i class="la la-dashboard"></i>
                        <span> Dashboard</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['home'])}}" href="{{ route('home') }}">Admin Dashboard</a></li>
                        
                    </ul>
                </li>
                

                <br>
                <li class="menu-title"> <span>ASSESSMENT</span> </li>

                <li class="{{set_active(['elementary/applicants','nonteaching/applicants'])}} submenu">
                    <a href="#" class="{{ set_active(['elementary/applicants','nonteaching/applicants'])}}">
                        <i class="la la-user-plus"></i> <span>New Applicants</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['elementary/applicants'])}}" href="{{ route('elementary/applicants') }}">SPET Applicants</a></li>
                        <!-- <li><a class="" href="#">Elementary Applicants</a></li>
                        <li><a class="" href="#">JHS Applicants</a></li>
                        <li><a class="" href="#">SHS Applicants</a></li>
                        <li><a class="" href="#">Non-Teaching</a></li> -->
                    </ul>
                </li>
                
                <li class="{{set_active(['view/all/applicants/rating'])}}">
                    <a href="{{ route('view/all/applicants/rating') }}" class="{{ set_active(['view/all/applicants/rating'])}}">
                        <i class="la la-chalkboard"></i>  <span>Ratings</span></span>
                    </a>
                </li>
                <br>
                <li class="menu-title"> <span>ADMINISTRATION</span> </li>
                <li class="{{set_active(['elementary/applicants/done/assessment'])}} submenu">
                    <a href="#" class="{{ set_active(['elementary/applicants/done/assessment'])}}">
                        <i class="la la-id-card"></i> <span>Applicants (Teaching)</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                    <li><a class="{{set_active(['elementary/applicants/done/assessment'])}}" href="{{ route('elementary/applicants/done/assessment') }}">SPET Applicants</a></li>
                        <!-- <li><a class="" href="#">Elementary Applicants</a></li>
                        <li><a class="" href="#">JHS Applicants</a></li>
                        <li><a class="" href="#">SHS Applicants</a></li>
                        <li><a class="" href="#">Non-Teaching</a></li> -->
                    </ul>
                </li>
                <!-- <li class="{{ set_active(['#'])}}">
                    <a href="#" class="{{ set_active(['#'])}}">
                        <i class="la la-id-card"></i>  <span>Applicants (Non-Teaching)</span>
                    </a>
                </li> -->


                </ul>
        </div>
    </div>
</div>  
<!-- --------------------- DATA ADMIN --------------------------------------------------------------------------------------------------- -->

<!-- --------------------- EVALUATOR ---------------------------------------------------------------------------------------------------- -->

@elseif (Auth::user()->hr_user_role=='Evaluator')

<div class="sidebar" id="sidebar" style="background-color: #01371d;">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>MAIN</span>
                </li>

                <li class="{{set_active(['home'])}} submenu">
                    <a href="#" class="{{ set_active(['home'])}}">
                        <i class="la la-dashboard"></i>
                        <span> Dashboard</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['home'])}}" href="{{ route('home') }}">Admin Dashboard</a></li>
                        
                    </ul>
                </li>
  
                <br>
                <li class="menu-title"> <span>ASSESSMENT</span> </li>

                <li class="{{set_active(['elementary/applicants','nonteaching/applicants'])}} submenu">
                    <a href="#" class="{{ set_active(['elementary/applicants','nonteaching/applicants'])}}">
                        <i class="la la-user-plus"></i> <span>New Applicants</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['elementary/applicants'])}}" href="{{ route('elementary/applicants') }}">SPET Applicants</a></li>
                        <!-- <li><a class="" href="#">Elementary Applicants</a></li>
                        <li><a class="" href="#">JHS Applicants</a></li>
                        <li><a class="" href="#">SHS Applicants</a></li>
                        <li><a class="" href="#">Non-Teaching</a></li> -->
                    </ul>
                </li>
                <li class="{{set_active(['view/all/applicants/rating'])}}">
                    <a href="{{ route('view/all/applicants/rating') }}" class="{{ set_active(['view/all/applicants/rating'])}}">
                        <i class="la la-chalkboard"></i>  <span>Ratings</span></span>
                    </a>
                </li>
                <br>
                <li class="menu-title"> <span>ADMINISTRATION</span> </li>
                <li class="{{set_active(['elementary/applicants/done/assessment'])}} submenu">
                    <a href="#" class="{{ set_active(['elementary/applicants/done/assessment'])}}">
                        <i class="la la-id-card"></i> <span>Applicants (Teaching)</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                    <li><a class="{{set_active(['elementary/applicants/done/assessment'])}}" href="{{ route('elementary/applicants/done/assessment') }}">SPET Applicants</a></li>
                        <!-- <li><a class="" href="#">Elementary Applicants</a></li>
                        <li><a class="" href="#">JHS Applicants</a></li>
                        <li><a class="" href="#">SHS Applicants</a></li>
                        <li><a class="" href="#">Non-Teaching</a></li> -->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>  
<!-- --------------------- EVALUATOR --------------------------------------------------------------------------------------------------- -->

@endif

<!-- /Sidebar -->