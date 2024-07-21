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
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <a style="color: black;" href="{{ route('all/employee/profile') }}">
                    <div class="card dash-widget">
                        <div class="card-body"> <span class="dash-widget-icon3"><i class="fa fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ Session::get('employeeCount') }}</h3> <span>Employees</span>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <a style="color: black;" href="{{ route('admin/leave/applications') }}">
                    <div class="card dash-widget">
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-check-square-o"></i></span>
                            <div class="dash-widget-info">
                                <h3>2</h3> <span>Pending Approval (Leave)</span>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <a style="color: black;" href="{{ route('admin/travel/order') }}">
                    <div class="card dash-widget">
                        <div class="card-body"> <span class="dash-widget-icon2"><i class="fa fa-check-square-o"></i></span>
                            <div class="dash-widget-info">
                                <h3>1</h3> <span>Pending Approval (Travel Order)</span>
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
                <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <h4 class="card-title">Today Absent <span class="badge bg-inverse-danger ml-2">5</span></h4>
                            <div class="leave-info-box">
                                <div class="media align-items-center">
                                    <a href="profile.html" class="avatar"><img alt="" src="assets/images/photo_defaults.png"></a>
                                    <div class="media-body">
                                        <div class="text-sm my-0">Conception Alcober</div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="col-6">
                                        <h6 class="mb-0">10 August 2023</h6> <span class="text-sm text-muted">Leave Date</span> </div>
                                    <div class="col-6 text-right"> <span class="badge bg-inverse-success">Approved</span> </div>
                                </div>
                            </div>
                            <div class="leave-info-box">
                                <div class="media align-items-center">
                                    <a href="profile.html" class="avatar"><img alt="" src="assets/images/photo_defaults.png"></a>
                                    <div class="media-body">
                                        <div class="text-sm my-0">Jasmin Cardenas</div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="col-6">
                                        <h6 class="mb-0">10 August 2023</h6> <span class="text-sm text-muted">Leave Date</span> </div>
                                    <div class="col-6 text-right"> <span class="badge bg-inverse-danger">Pending</span> </div>
                                </div>
                            </div>
                            <div class="load-more text-center"> <a class="text-dark" href="{{ route('admin/leave/applications') }}">Load More</a> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <h4 class="card-title">On Travel <span class="badge bg-inverse-danger ml-2">3</span></h4>
                            <div class="leave-info-box">
                                <div class="media align-items-center">
                                    <a href="profile.html" class="avatar"><img alt="" src="assets/images/photo_defaults.png"></a>
                                    <div class="media-body">
                                        <div class="text-sm my-0">Jessryll Almacin</div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="col-6">
                                        <h6 class="mb-0">10 August 2023</h6> <span class="text-sm text-muted">Leave Date</span> </div>
                                    <div class="col-6 text-right"> <span class="badge bg-inverse-danger">Pending</span> </div>
                                </div>
                            </div>
                            <div class="leave-info-box">
                                <div class="media align-items-center">
                                    <a href="profile.html" class="avatar"><img alt="" src="assets/images/photo_defaults.png"></a>
                                    <div class="media-body">
                                        <div class="text-sm my-0">Juana Jennah Dela Pena</div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="col-6">
                                        <h6 class="mb-0">10 August 2023</h6> <span class="text-sm text-muted">Leave Date</span> </div>
                                    <div class="col-6 text-right"> <span class="badge bg-inverse-success">Approved</span> </div>
                                </div>
                            </div>
                            <div class="load-more text-center"> <a class="text-dark" href="{{ route('admin/travel/order') }}">Load More</a> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                    <div class="card flex-fill">
                    <div class="card-body">
                        <h4 class="card-title">Todo</h4>
                        <div class="add-items d-flex">
                        <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
                        <button class="add btn btn-success font-weight-medium todo-list-add-btn">Add</button>
                        </div>
                        <div class="list-wrapper" style="margin-top:10px">
                        <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                            <li class="completed">
                            <div class="form-check form-check-flat" style="margin-top:10px">
                                <label class="form-check-label">
                                <input class="checkbox" type="checkbox" checked> Upload Memo </label>
                            </div>
                            <i class="remove mdi mdi-close-circle-outline"></i>
                            </li>
                            <li>
                            <div class="form-check form-check-flat" style="margin-top:10px">
                                <label class="form-check-label">
                                <input class="checkbox" type="checkbox"> Check Absents </label>
                            </div>
                            <i class="remove mdi mdi-close-circle-outline"></i>
                            </li>
                            <li>
                            <div class="form-check form-check-flat" style="margin-top:10px">
                                <label class="form-check-label">
                                <input class="checkbox" type="checkbox"> Print Statements </label>
                            </div>
                            <i class="remove mdi mdi-close-circle-outline"></i>
                            </li>
                            <li class="completed">
                            <div class="form-check form-check-flat" style="margin-top:10px">
                                <label class="form-check-label">
                                <input class="checkbox" type="checkbox" checked> Prepare for presentation </label>
                            </div>
                            <i class="remove mdi mdi-close-circle-outline"></i>
                            </li>
                        </ul>
                        </div>
                    </div>
                    </div>
                </div>     
            </div>
            <!-- /Statistics Widget -->
            
        </div>
        <!-- /Page Content -->
    </div>
@endsection