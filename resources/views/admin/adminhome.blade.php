@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- <h3 class="page-title">Welcome {{ Session::get('name') }}!</h3> -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Admin Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <a style="color: black;" href="{{ route('all/employee/profile') }}">
                    <div class="card dash-widget">
                        <div class="card-body"> <span class="dash-widget-icon3"><i class="fa fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ Session::get('employeeCount') }}</h3> <span>Account Users</span>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <a style="color: black;" href="{{ route('all/employee/profile') }}">
                    <div class="card dash-widget">
                        <div class="card-body"> <span class="dash-widget-icon2"><i class="fa fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>2,107</h3> <span>Elementary Applicants</span>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <a style="color: black;" href="{{ route('all/employee/profile') }}">
                    <div class="card dash-widget">
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>1,852</h3> <span>JHS Applicants</span>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <a style="color: black;" href="{{ route('all/employee/profile') }}">
                    <div class="card dash-widget">
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>1,324</h3> <span>SHS Applicants</span>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}

            <!-- Statistics Widget -->
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card flex-fill dash-statistics">
                        <div class="card-body">
                            <h5 class="card-title">Municipal with the Highest Number of Applicants</h5>
                            <div class="stats-list">
                                
                                <div class="stats-info">
                                    <p>PALO <strong>190 <small>/ 5,283</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>CARIGARA <strong>150 <small>/ 5,283</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>ABUYOG <strong>130 <small>/ 5,283</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 47%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>TANAUAN <strong>120 <small>/ 5,283</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 39%" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>MAYORGA <strong>101 <small>/ 5,283</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="load-more text-center"> <a class="text-blue" href="javascript:void(0);">Load More</a> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <h4 class="card-title">Specialization Statistics</h4>
                            <div class="statistics">
                                <div class="row">
                                    <div class="col-md-6 col-6 text-center">
                                        <div class="stats-box mb-4">
                                            <p>Total Applicants</p>
                                            <h3>5,283</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6 text-center">
                                        <div class="stats-box mb-4">
                                            <p>Inactive</p>
                                            <h3>37</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">30%</div>
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 28%" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">28%</div>
                                <div class="progress-bar bg-success" role="progressbar" style="width: 24%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">24%</div>
                                <div class="progress-bar bg-green" role="progressbar" style="width: 21%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">21%</div>
                                <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">10%</div>
                            </div>
                            <div>
                                <p><i class="fa fa-dot-circle-o text-danger mr-2"></i>Cookery <span class="float-right">266</span></p>
                                <p><i class="fa fa-dot-circle-o text-warning mr-2"></i>Food and Beverages <span class="float-right">215</span></p>
                                <p><i class="fa fa-dot-circle-o text-success mr-2"></i>Electrical Installation & Maintenance <span class="float-right">161</span></p>
                                <p><i class="fa fa-dot-circle-o text-green mr-2"></i>Caregiving <span class="float-right">147</span></p>
                                <p class="mb-0"><i class="fa fa-dot-circle-o text-info mr-2"></i>Housekeeping <span class="float-right">85</span></p>
                            </div>
                            <hr>
                            <div class="load-more text-center"> <a class="text-blue" href="javascript:void(0);">Load More</a> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Statistics Widget -->
            
        </div>
        <!-- /Page Content -->
    </div>
@endsection