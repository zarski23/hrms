@extends('layouts.master')
@section('content')

    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Employee Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Main</a></li>
                            <li class="breadcrumb-item active"><a class="" href="">User Controller</a></li>
                            <li class="breadcrumb-item active"><a class="" href="{{ route('all/employee/profile') }}">All Employee</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}

            <!-- /Page Header -->
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#">
                                        <a href="#"><img alt="" src="{{ URL::to('/assets/images/'. $user->image) }}" alt="{{ $user->first_name }}"></a>
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</h3>
                                                <div class="staff-id">Employee ID : {{ $user->employee_id }}</div>
                                                <div class="small doj text-muted">Date Hired : {{ $user->date_hired }}</div>
                                                <div class="small doj text-muted">User Role : {{ $user->hr_user_role }}</div>
                                                <div class="staff-msg"><a class="btn btn-custom" href="">Send Message</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                               
                                                <li>
                                                    
                                                    <div class="title">Position:</div>
                                                    @if(!empty($employeeProfile->position_name))
                                                    <div class="text">{{ $employeeProfile->position_name }}</div>
                                                    @else
                                                    <div class="text">N/A <small class="text-danger"> (Authorized Admin Only)</small></div>
                                                    @endif
                                                </li>
                                                <li>
                                                    <div class="title">Department:</div>
                                                    @if(!empty($employeeProfile->department_name))
                                                    <div class="text">{{ $employeeProfile->department_name }}</div>
                                                    @else
                                                    <div class="text">N/A <small class="text-danger"> (Authorized Admin Only)</small></div>
                                                    @endif
                                                </li>
                                                <li>
                                                    <div class="title">Designation:</div>
                                                    @if(!empty($employeeProfile->employment_type))
                                                    <div class="text">{{ $employeeProfile->employment_type }}</div>
                                                    @else
                                                    <div class="text">N/A <small class="text-danger"> (Authorized Admin Only)</small></div>
                                                    @endif
                                                </li>
                                                <li>
                                                    <div class="title">Biometric ID:</div>
                                                    @if(!empty($employeeProfile->dtr_id))
                                                    <div class="text">{{ $employeeProfile->dtr_id }}</div>
                                                    @else
                                                    <div class="text">N/A <small class="text-danger"> (Authorized Admin Only)</small></div>
                                                    @endif
                                                </li>
                                                <li>
                                                    <div class="title">Status:</div>
                                                    <div class="text">{{ $user->status }}</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
					
            <div class="card tab-box">
                <div class="row user-tabs">
                    <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
                            
                            <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Salary and Taxes</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="tab-content">
                <!-- Profile Info Tab -->
                <div id="emp_profile" class="pro-overview tab-pane fade show active">
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Personal Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a></h3>
                                    @if (!empty($employeeInformation))
                                        <ul class="personal-info">
                                            <li>
                                                <div class="title">Age</div>
                                                <div class="text">{{ $employeeInformation->age }}</div>
                                                @if (empty($employeeInformation->age))
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Gender</div>
                                                <div class="text">{{ $employeeInformation->gender }}</div>
                                                @if (empty($employeeInformation->gender))
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Mobile No.</div>
                                                <div class="text">{{ $employeeInformation->mobile_number }}</div>
                                                @if (empty($employeeInformation->mobile_number))
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Email</div>
                                                <div class="text">{{ $user->email }}</div>
                                                @if (empty($user->email))
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Address</div>
                                                <div class="text">{{ $employeeInformation->address }}</div>
                                                @if (empty($employeeInformation->address))
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Birth Date</div>
                                                <div class="text">{{ $employeeInformation->birth_date }}</div>
                                                @if (empty($employeeInformation->birth_date))
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Marital status</div>
                                                <div class="text">{{ $employeeInformation->marital_status }}</div>
                                                @if (empty($employeeInformation->marital_status))
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Tin No.</div>
                                                <div class="text">{{ $employeeInformation->tin_number }}</div>
                                                @if (empty($employeeInformation->tin_number))
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="title">Philhealth No.</div>
                                                <div class="text">{{ $employeeInformation->philhealth_number }}</div>
                                                @if (empty($employeeInformation->philhealth_number))
                                                <div class="text">N/A</div>
                                                @endif
                                            </li>
                                        </ul>
                                    @else
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Age</div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Gender</div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Mobile No.</div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Email</div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Address</div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Birth Date</div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Marital status</div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Tin No.</div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Philhealth No.</div>
                                            <div class="text">N/A</div>
                                        </li>
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Work Schedule<a href="#" class="edit-icon" data-toggle="modal" data-target="#work_schedule_modal"><i class="fa fa-pencil"></i></a></h3>
                                       @if($employeeSchedule !== null && !$employeeSchedule->isEmpty())
                                        <ul class="personal-info">
                                        <li>
                                            <div class="title">Shift cut-off date</div>
                                            <div class="text">{{ $employeeSchedule->first()->cut_off_date }}</div>
                                            @if (empty($employeeSchedule->first()->cut_off_date))
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Shift type </div>
                                            <div class="text">{{ $employeeSchedule->first()->shift_type }}</div>
                                            @if (empty($employeeSchedule->first()->shift_type))
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Time-in</div>
                                            <div class="text">{{ $employeeSchedule->first()->start_time }}</div>
                                            @if (empty($employeeSchedule->first()->start_time))
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Break-out </div>
                                            <div class="text">{{ $employeeSchedule->first()->break_out_time }}</div>
                                            @if (empty($employeeSchedule->first()->break_out_time))
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Break-in </div>
                                            <div class="text">{{ $employeeSchedule->first()->break_in_time }}</div>
                                            @if (empty($employeeSchedule->first()->break_in_time))
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="title">Time-out </div>
                                            <div class="text">{{ $employeeSchedule->first()->end_time }}</div>
                                            @if (empty($employeeSchedule->first()->end_time))
                                            <div class="text">N/A</div>
                                            @endif
                                        </li>
                                        </ul>
                                        @else
                                        <ul class="personal-info">
                                        <li>
                                            <div class="title">Shift cut-off date</div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Shift type </div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Time-in</div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Break-out </div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Break-in </div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Time-out </div>
                                            <div class="text">N/A</div>
                                        </li>
                                        </ul>
                                        @endif
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Other Informations</h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Info </div>
                                            <div class="text">N/A</div>
                                        </li>
                                        <li>
                                            <div class="title">Info</div>
                                            <div class="text">N/A</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Family Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#family_info_modal"><i class="fa fa-pencil"></i></a></h3>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Relationship</th>
                                                    <th>Date of Birth</th>
                                                    <th>Phone</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                    <td>N/A</td>
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                <a href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="row">
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Education Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#education_info"><i class="fa fa-pencil"></i></a></h3>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">Eastern Visayas State University</a>
                                                        <div>BS Intermation Technology</div>
                                                        <span class="time">2020 - 2024</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">Eastern Visayas State University</a>
                                                        <div>BS Intermation Technology</div>
                                                        <span class="time">2020 - 2024</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Experience <a href="#" class="edit-icon" data-toggle="modal" data-target="#experience_info"><i class="fa fa-pencil"></i></a></h3>
                                    <div class="experience-box">
                                        <ul class="experience-list">
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">Web Designer at ZT Corporation</a>
                                                        <span class="time">December 2020 - Present (2 years 8 months)</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">Web Developer at Telecom</a>
                                                        <span class="time">January 2019 - December 2020</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="experience-user">
                                                    <div class="before-circle"></div>
                                                </div>
                                                <div class="experience-content">
                                                    <div class="timeline-content">
                                                        <a href="#/" class="name">IT Specialist at IT Technology</a>
                                                        <span class="time">February 2017 - September 2018</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- /Profile Info Tab -->
                
                <!-- Basic Salary Information Tab -->
                <div class="tab-pane fade" id="bank_statutory">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"> Basic Salary Information<a href="#" class="edit-icon" data-toggle="modal" data-target="#salary_modal"><i class="fa fa-pencil"></i></a></h3>
                            <form>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Salary Grade</label>
                                            @if(!empty($employeeSalary))
                                            <input readonly type="text" class="form-control" value="{{ $employeeSalary->salary_grade }}">
                                            @else
                                            <input readonly type="text" class="form-control" value="N/A">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Salary Rate<small class="text-muted"> per day</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₱</span>
                                                </div>
                                                @if(!empty($employeeSalary))
                                                <input readonly type="text" class="form-control" value="{{ $employeeSalary->daily_salary }}">
                                                @else
                                                <input readonly type="text" class="form-control" value="N/A">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Tax</label>
                                            @if(!empty($employeeSalary))
                                            <input readonly type="text" class="form-control" value="{{ $employeeSalary->taxable }}">
                                            @else
                                            <input readonly type="text" class="form-control" value="N/A">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h3 class="card-title"> Community Tax Information<a href="#" class="edit-icon" data-toggle="modal" data-target="#communityTax_modal"><i class="fa fa-pencil"></i></a></h3>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Number </label>
                                            @if(!empty($employeeCommunityTax))
                                            <input readonly type="text" class="form-control" value="{{ $employeeCommunityTax->number }}">
                                            @else
                                            <input readonly type="text" class="form-control" value="N/A">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Date</label>
                                            @if(!empty($employeeCommunityTax))
                                            <input readonly type="text" class="form-control" value="{{ $employeeCommunityTax->date }}">
                                            @else
                                            <input readonly type="text" class="form-control" value="N/A">
                                            @endif
                                
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Place of Issue</label>
                                            @if(!empty($employeeCommunityTax))
                                            <input readonly type="text" class="form-control" value="{{ $employeeCommunityTax->place_issued }}">
                                            @else
                                            <input readonly type="text" class="form-control" value="N/A">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>
                               
                                <!-- <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="submit">Save</button>
                                </div> -->

                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Basic Salary Information Tab -->
            </div>
        </div>
        <!-- /Page Content -->

<!-- ---------------------------------------------------------------------------------------------------------------------------- -->

        @if(!empty($employeeProfile))
        <!-- Profile Information Modal -->
        <div id="profile_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Profile Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/employee/profile/information/save') }}" method="POST" enctype="multipart/form-data" id="employeeProfileForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="profile-img-wrap edit-img">
                                        <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="{{ $user->employee_id }}">
                                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $user->id }}">
                                        <img class="inline-block" src="{{ URL::to('/assets/images/'. $user->image) }}" alt="{{ $user->name }}">
                                        <div class="fileupload btn">
                                            <span class="btn-text">edit</span>
                                            <input class="upload" type="file" id="upload_picture" name="upload_picture">
                                        </div>
                                    </div>
                                    <p style="text-align: center; color: blue;" id="output"></p>

                                    <script>
                                        const upload_picture = document.getElementById('upload_picture');
                                        const output = document.getElementById('output');

                                        upload_picture.addEventListener('change', function() {
                                            // This code will run when a file is selected
                                            const selectedFile = upload_picture.files[0];
                                            if (selectedFile) {
                                                output.textContent = `Selected Image: ${selectedFile.name}`;
                                            } else {
                                                output.textContent = 'No file selected.';
                                            }
                                        });
                                    </script>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>First Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="fname" name="fname" value="{{ $user->first_name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Middle Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="mname" name="mname" value="{{ $user->middle_name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Last Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="lname" name="lname" value="{{ $user->last_name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date Hired <span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker @error('date_hired') is-invalid @enderror" type="text" name="date_hired" value="{{ $user->date_hired }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>User Role <span class="text-danger">*</span></label>
                                                <select class="select form-control" id="employeeRole" name="employeeRole">
                                                    <option style="color: white; background-color: gray;" value="{{ $user->hr_user_role }}" {{ ( $user->hr_user_role == $user->hr_user_role) ? 'selected' : '' }}> {{ $user->hr_user_role }} </option>
                                                    <option value="employee">employee</option>
                                                    <option value="admin">admin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Position <span class="text-danger">*</span></label>
                                                <select name="employee_position" class="form-control" id="employee_position">
                                                    <option style="color: white; background-color: gray;" value="{{ $employeeProfile->position_name }}" {{ ( $employeeProfile->position_name == $employeeProfile->position_name) ? 'selected' : '' }}> {{ $employeeProfile->position_name }} </option>
                                                    @foreach ($employeePositions as $key=>$employeePosition )
                                                    <option value="{{ $employeePosition->position_name }}">{{ $employeePosition->position_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="selectErrorPosition" class="invalid-feedback" style="display: none;"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Department <span class="text-danger">*</span></label>
                                                <select name="employee_department" class="form-control" id="employee_department">
                                                    <option style="color: white; background-color: gray;" value="{{ $employeeProfile->department_name }}" {{ ( $employeeProfile->department_name == $employeeProfile->department_name) ? 'selected' : '' }}> {{ $employeeProfile->department_name }} </option>
                                                    @foreach ($employeeDepartment as $key=>$department )
                                                    <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="selectErrorDepartment" class="invalid-feedback" style="display: none;"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Designation <span class="text-danger">*</span></label>
                                                <select name="employmentType" class="form-control" id="employee_designation">
                                                    <option style="color: white; background-color: gray;" value="{{ $employeeProfile->employment_type }}" {{ ( $employeeProfile->employment_type == $employeeProfile->employment_type) ? 'selected' : '' }}> {{ $employeeProfile->employment_type }} </option>
                                                    @foreach ($employmentType as $key=>$employmentType )
                                                    <option value="{{ $employmentType->employment_type }}">{{ $employmentType->employment_type }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="selectErrorDesignation" class="invalid-feedback" style="display: none;"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Biometric ID <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="dtr_id" name="dtr_id" value="{{ $employeeProfile->dtr_id }}">
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status <span class="text-danger">*</span></label>
                                                <select class="select form-control" id="employeeStatus" name="employeeStatus">
                                                    <option style="color: white; background-color: gray;" value="{{ $user->status }}" {{ ( $user->status == $user->status) ? 'selected' : '' }}> {{ $user->status }} </option>
                                                    <option value="active">active</option>
                                                    <option value="inactive">inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    

                                </div>
                            </div>
                            
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn" id="submit-profile-button">Submit</button>
                            </div>
                        </form>
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                var form = document.getElementById("employeeProfileForm");
                                var employee_position = document.getElementById("employee_position");
                                var selectErrorPosition = document.getElementById("selectErrorPosition");
                                var employee_department = document.getElementById("employee_department");
                                var selectErrorDepartment = document.getElementById("selectErrorDepartment");
                                var employee_designation = document.getElementById("employee_designation");
                                var selectErrorDesignation = document.getElementById("selectErrorDesignation");

                                form.addEventListener("submit", function (event) {
                                    if (employee_position.value === "") {
                                        event.preventDefault(); // Prevent form submission
                                        employee_position.classList.add("highlight-empty-select");
                                        selectErrorPosition.style.display = "block"; // Display the error message
                                        selectErrorPosition.textContent = "Please select an Employee Position"; // Set the error message
                                    } else {
                                        // Remove the highlight and hide the error message if the select element is not empty
                                        employee_position.classList.remove("highlight-empty-select");
                                        selectErrorPosition.style.display = "none";
                                    }
                                    if (employee_department.value === "") {
                                        event.preventDefault(); // Prevent form submission
                                        employee_department.classList.add("highlight-empty-select");
                                        selectErrorDepartment.style.display = "block"; // Display the error message
                                        selectErrorDepartment.textContent = "Please select an Employee Department"; // Set the error message
                                    } else {
                                        // Remove the highlight and hide the error message if the select element is not empty
                                        employee_department.classList.remove("highlight-empty-select");
                                        selectErrorDepartment.style.display = "none";
                                    }
                                    if (employee_designation.value === "") {
                                        event.preventDefault(); // Prevent form submission
                                        employee_designation.classList.add("highlight-empty-select");
                                        selectErrorDesignation.style.display = "block"; // Display the error message
                                        selectErrorDesignation.textContent = "Please select an Employee Designation"; // Set the error message
                                    } else {
                                        // Remove the highlight and hide the error message if the select element is not empty
                                        employee_designation.classList.remove("highlight-empty-select");
                                        selectErrorDesignation.style.display = "none";
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Profile Information Modal -->
        @else
        <!-- Profile Information Modal -->
        <!-- <div id="profile_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Profile Information Empty</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/employee/profile/information/save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <div class="profile-img-wrap edit-img">
                                        <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="{{ $user->employee_id }}">
                                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $user->id }}">
                                        <img class="inline-block" src="{{ URL::to('/assets/images/'. $user->image) }}" alt="{{ $user->name }}">
                                        <div class="fileupload btn">
                                            <span class="btn-text">edit</span>
                                            <input class="upload" type="file" id="upload_picture" name="upload_picture">
                                        </div>
                                    </div>
                                    <p style="text-align: center; color: blue;" id="output"></p>

                                    <script>
                                        const upload_picture1 = document.getElementById('upload_picture');
                                        const output1 = document.getElementById('output');

                                        upload_picture1.addEventListener('change', function() {
                                            // This code will run when a file is selected
                                            const selectedFile = upload_picture1.files[0];
                                            if (selectedFile) {
                                                output1.textContent = `Selected Image: ${selectedFile.name}`;
                                            } else {
                                                output1.textContent  = 'No file selected.';
                                            }
                                        });
                                    </script>

                                    
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" id="fname" name="fname" value="{{ $user->first_name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Middle Name</label>
                                                    <input type="text" class="form-control" id="mname" name="mname" value="{{ $user->middle_name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" id="lname" name="lname" value="{{ $user->last_name }}">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date Hired</label>
                                                    <div class="form-group">
                                                        <div class="cal-icon">
                                                            <input class="form-control datetimepicker @error('date_hired') is-invalid @enderror" type="text" name="date_hired" value="{{ $user->date_hired }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Position<span class="text-danger">*</span></label>
                                                <select name="employee_position" class="form-control" id="employee_position" class="form-control @error('password') is-invalid @enderror">
                                                    <option value="">--- Please select Employee Position ---</option>
                                                    @foreach ($employeePositions as $key=>$employeePosition )
                                                    <option value="{{ $employeePosition->position_name }}">{{ $employeePosition->position_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('employee_position')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Department<span class="text-danger">*</span></label>
                                                <select name="employee_department" class="form-control">
                                                    <option value="">--- Please select Employee Department ---</option>
                                                    @foreach ($employeeDepartment as $key=>$department )
                                                    <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Designation<span class="text-danger">*</span></label>
                                                <select name="employmentType" class="form-control">
                                                    <option value="">--- Please select Designation ---</option>
                                                    @foreach ($employmentType as $key=>$employmentType )
                                                    <option value="{{ $employmentType->employment_type }}">{{ $employmentType->employment_type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Briometric ID<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="dtr_id" name="dtr_id" placeholder="ID from Biometric">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="select form-control" id="employeeStatus" name="employeeStatus">
                                                    <option style="color: white; background-color: gray;" value="{{ $user->status }}" {{ ( $user->status == $user->status) ? 'selected' : '' }}> {{ $user->status }} </option>
                                                    <option value="active">active</option>
                                                    <option value="inactive">inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- /Profile Information Modal -->
        @endif
    
        @if (!empty($employeeInformation))
        <!-- Personal Information Modal -->
        <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Personal Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/employee/information/save') }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}" readonly>
                            <input type="hidden" class="form-control" name="employee_id" value="{{ $user->employee_id }}" readonly>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ $employeeInformation->age }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select class="select form-control @error('gender') is-invalid @enderror" name="gender">
                                            <option value="{{ $employeeInformation->gender }}" {{ ( $employeeInformation->gender == $employeeInformation->gender) ? 'selected' : '' }}> {{ $employeeInformation->gender }} </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile No.</label>
                                        <input class="form-control @error('mobile_number') is-invalid @enderror" type="text" name="mobile_number" value="{{ $employeeInformation->mobile_number }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control @error('email_address') is-invalid @enderror" type="text" name="email_address" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" value="{{ $employeeInformation->address }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <div class="form-group">
                                            <div class="cal-icon">
                                                <input class="form-control datetimepicker @error('birth_date') is-invalid @enderror" type="text" name="birth_date" value="{{ $employeeInformation->birth_date }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Marital status <span class="text-danger">*</span></label>
                                        <select class="select form-control @error('marital_status') is-invalid @enderror" name="marital_status">
                                            <option value="{{ $employeeInformation->marital_status }}" {{ ( $employeeInformation->marital_status == $employeeInformation->marital_status) ? 'selected' : '' }}> {{ $employeeInformation->marital_status }} </option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tin No.</label>
                                        <input class="form-control @error('tin_number') is-invalid @enderror" type="text" name="tin_number" value="{{ $employeeInformation->tin_number }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Philhealth No.</label>
                                        <input class="form-control @error('philhealth_number') is-invalid @enderror" type="text" name="philhealth_number" value="{{ $employeeInformation->philhealth_number }}">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Personal Information Modal -->
        @else
         <!-- Personal Information Modal -->
        <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Personal Information empty</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/employee/information/save') }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}" readonly>
                            <input type="hidden" class="form-control" name="employee_id" value="{{ $user->employee_id }}" readonly>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input type="text" class="form-control @error('age') is-invalid @enderror" name="age">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="select form-control @error('gender') is-invalid @enderror" name="gender">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile No.</label>
                                        <input class="form-control @error('mobile_number') is-invalid @enderror" type="text" name="mobile_number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control @error('email_address') is-invalid @enderror" type="text" name="email_address">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input class="form-control @error('address') is-invalid @enderror" type="text" name="address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <div class="form-group">
                                            <div class="cal-icon">
                                                <input class="form-control datetimepicker @error('birth_date') is-invalid @enderror" type="text" name="birth_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Marital status <span class="text-danger">*</span></label>
                                        <select class="select form-control @error('marital_status') is-invalid @enderror" name="marital_status">
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tin No.</label>
                                        <input class="form-control @error('tin_number') is-invalid @enderror" type="text" name="tin_number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Philhealth No. </label>
                                        <input class="form-control @error('philhealth_number') is-invalid @enderror" type="text" name="philhealth_number">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Personal Information Modal -->
        @endif
        
        @if ($employeeSchedule !== null && !$employeeSchedule->isEmpty())

      
        <div id="work_schedule_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Work Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/update/work/schedule') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}" readonly>
                                    <input type="hidden" class="form-control" name="dtr_id" value="{{ $employeeProfile->dtr_id }}" readonly>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Shift cut-off date <span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <div class="cal-icon">
                                                    <input class="form-control datetimepicker @error('shift_cut_off') is-invalid @enderror" type="text" name="shift_cut_off" value="{{$employeeSchedule->first()->cut_off_date}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Shift type<span class="text-danger">*</span></label>
                                                <select name="shift_type" class="form-control" id="shift_type" >
                                                    <option style="color: white; background-color: gray;" value="{{$employeeSchedule->first()->shift_type}}"> {{$employeeSchedule->first()->shift_type}}</option>
                                                    @foreach ($workingSchedules as $key=>$workingSchedules )
                                                    <option value="{{ $workingSchedules->id }}" data-start_time={{ $workingSchedules->start_time }} data-break_out_time={{ $workingSchedules->break_out_time }} data-break_in_time={{ $workingSchedules->break_in_time }} data-end_time={{ $workingSchedules->end_time }}>{{ $workingSchedules->shift_type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Time-in <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="start_time" name="start_time" placeholder="{{$employeeSchedule->first()->start_time}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Break-out  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="break_out_time" name="break_out_time" placeholder="{{$employeeSchedule->first()->break_out_time}}" readonly>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Break-in <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="break_in_time" name="break_in_time" placeholder="{{$employeeSchedule->first()->break_in_time}}" readonly>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Time-out  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="end_time" name="end_time" placeholder="{{$employeeSchedule->first()->end_time}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div id="work_schedule_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Work Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/update/work/schedule') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}" readonly>
                                    <input type="hidden" class="form-control" name="dtr_id" value="{{ $employeeProfile->dtr_id }}" readonly>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Shift cut-off date <span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <div class="cal-icon">
                                                    <input class="form-control datetimepicker @error('birth_date') is-invalid @enderror" type="text" name="shift_cut_off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Shift type<span class="text-danger">*</span></label>
                                                <select name="shift_type" class="form-control" id="shift_type">
                                                    <option style="color: white; background-color: gray;" value=""> </option>
                                                    @foreach ($workingSchedules as $key=>$workingSchedules )
                                                    <option value="{{ $workingSchedules->id }}" data-start_time={{ $workingSchedules->start_time }} data-break_out_time={{ $workingSchedules->break_out_time }} data-break_in_time={{ $workingSchedules->break_in_time }} data-end_time={{ $workingSchedules->end_time }}>{{ $workingSchedules->shift_type }}</option>
                                                    @endforeach
                                                </select>
                
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Time-in <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="start_time" name="start_time" placeholder="--:--" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Break-out  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="break_out_time" name="break_out_time" placeholder="--:--" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Break-in <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="break_in_time" name="break_in_time" placeholder="--:--" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Time-out  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="end_time" name="end_time" placeholder="--:--" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if (!empty($employeeSalary))
        <!-- Other Informations Salary Modal -->
        <div id="salary_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Basic Salary Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/employee/salary/save') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">SALARY</h3>
                                    <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}" readonly>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Salary Grade <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="salary_grade" value="{{$employeeSalary->salary_grade}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Salary Rate Per Day <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="salary_rate" value="{{$employeeSalary->daily_salary}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tax  <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="tax" value="{{$employeeSalary->taxable}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Other Informations Salary Modal -->
        @else
        <!-- Other Informations Salary Modal -->
        <div id="salary_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Basic Salary Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/employee/salary/save') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">SALARY</h3>
                                    <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}" readonly>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Salary Grade <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="salary_grade">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Salary Rate Per Day <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="salary_rate">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tax  <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="tax">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Other Informations Salary Modal -->
        @endif

        @if (!empty($employeeCommunityTax))
        <!-- Other Informations Community Tax Modal -->
        <div id="communityTax_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Community Tax Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/employee/communityTax/save') }}" method="POST">     
                            @csrf                       
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">COMMUNITY TAX</h3>
                                    <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}" readonly>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="tax_num" value="{{$employeeCommunityTax->number}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date <span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker @error('tax_date') is-invalid @enderror" type="text" name="tax_date" value="{{$employeeCommunityTax->date}}">
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Place of Issue <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="tax_place_issued" value="{{$employeeCommunityTax->place_issued}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Other Informations Community Tax Modal -->
        @else
        <!-- Other Informations Community Tax Modal -->
        <div id="communityTax_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Community Tax Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/employee/communityTax/save') }}" method="POST">     
                            @csrf                       
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">COMMUNITY TAX</h3>
                                    <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}" readonly>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="tax_num">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date <span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <div class="cal-icon">
                                                        <input class="form-control datetimepicker @error('tax_date') is-invalid @enderror" type="text" name="tax_date">
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Place of Issue <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="tax_place_issued">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Other Informations Community Tax Modal -->
        @endif
                
        <!-- Family Info Modal -->
        <div id="family_info_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Family Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Family Member <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of birth <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Relationship <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date of birth <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Family Info Modal -->

        <!-- Education Modal -->
        <!-- <div id="education_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Education Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Oxford University" class="form-control floating">
                                                    <label class="focus-label">Institution</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Computer Science" class="form-control floating">
                                                    <label class="focus-label">Subject</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="01/06/2002" class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Starting Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="31/05/2006" class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Complete Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="BE Computer Science" class="form-control floating">
                                                    <label class="focus-label">Degree</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Grade A" class="form-control floating">
                                                    <label class="focus-label">Grade</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Oxford University" class="form-control floating">
                                                    <label class="focus-label">Institution</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Computer Science" class="form-control floating">
                                                    <label class="focus-label">Subject</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="01/06/2002" class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Starting Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <div class="cal-icon">
                                                        <input type="text" value="31/05/2006" class="form-control floating datetimepicker">
                                                    </div>
                                                    <label class="focus-label">Complete Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="BE Computer Science" class="form-control floating">
                                                    <label class="focus-label">Degree</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus focused">
                                                    <input type="text" value="Grade A" class="form-control floating">
                                                    <label class="focus-label">Grade</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- /Education Modal -->
        
        <!-- Experience Modal -->
        <div id="experience_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Experience Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-scroll">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="Digital Devlopment Inc">
                                                    <label class="focus-label">Company Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="United States">
                                                    <label class="focus-label">Location</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="Web Developer">
                                                    <label class="focus-label">Job Position</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" value="01/07/2007">
                                                    </div>
                                                    <label class="focus-label">Period From</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" value="08/06/2018">
                                                    </div>
                                                    <label class="focus-label">Period To</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa fa-trash-o"></i></a></h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="Digital Devlopment Inc">
                                                    <label class="focus-label">Company Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="United States">
                                                    <label class="focus-label">Location</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input type="text" class="form-control floating" value="Web Developer">
                                                    <label class="focus-label">Job Position</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" value="01/07/2007">
                                                    </div>
                                                    <label class="focus-label">Period From</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <div class="cal-icon">
                                                        <input type="text" class="form-control floating datetimepicker" value="08/06/2018">
                                                    </div>
                                                    <label class="focus-label">Period To</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-more">
                                            <a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Experience Modal -->

        <!-- /Page Content -->
    </div>

    <script>
        // Function to populate the time dropdown
        function populateTimeDropdown() {
            var timeSelect_start_time = document.getElementById("timeSelect_start_time");
            var timeSelect_break_out_time = document.getElementById("timeSelect_break_out_time");
            var timeSelect_break_in_time = document.getElementById("timeSelect_break_in_time");
            var timeSelect_end_time = document.getElementById("timeSelect_end_time");
            
            // Create options for hours (24-hour format) and minutes
            for (var hour = 0; hour < 24; hour++) {
                for (var minute = 0; minute < 60; minute += 30) {
                    var formattedHour = hour.toString().padStart(2, '0');
                    var formattedMinute = minute.toString().padStart(2, '0');
                    var timeOption = formattedHour + ":" + formattedMinute;
                    
                    var option = document.createElement("option");
                    option.text = timeOption;
                    option.value = timeOption;
                    timeSelect_start_time.appendChild(option);
                }
            }
            for (var hour = 0; hour < 24; hour++) {
                for (var minute = 0; minute < 60; minute += 30) {
                    var formattedHour = hour.toString().padStart(2, '0');
                    var formattedMinute = minute.toString().padStart(2, '0');
                    var timeOption = formattedHour + ":" + formattedMinute;
                    
                    var option = document.createElement("option");
                    option.text = timeOption;
                    option.value = timeOption;
                    timeSelect_break_out_time.appendChild(option);
                }
            }
            for (var hour = 0; hour < 24; hour++) {
                for (var minute = 0; minute < 60; minute += 30) {
                    var formattedHour = hour.toString().padStart(2, '0');
                    var formattedMinute = minute.toString().padStart(2, '0');
                    var timeOption = formattedHour + ":" + formattedMinute;
                    
                    var option = document.createElement("option");
                    option.text = timeOption;
                    option.value = timeOption;
                    timeSelect_break_in_time.appendChild(option);
                }
            }
            for (var hour = 0; hour < 24; hour++) {
                for (var minute = 0; minute < 60; minute += 30) {
                    var formattedHour = hour.toString().padStart(2, '0');
                    var formattedMinute = minute.toString().padStart(2, '0');
                    var timeOption = formattedHour + ":" + formattedMinute;
                    
                    var option = document.createElement("option");
                    option.text = timeOption;
                    option.value = timeOption;
                    timeSelect_end_time.appendChild(option);
                }
            }
        }
        
        // Call the function to populate the dropdown
        populateTimeDropdown();
    </script>

    <script>
        
        $('#shift_type').on('change',function()
        {
            $('#start_time').val($(this).find(':selected').data('start_time'));
            $('#break_out_time').val($(this).find(':selected').data('break_out_time'));
            $('#break_in_time').val($(this).find(':selected').data('break_in_time'));
            $('#end_time').val($(this).find(':selected').data('end_time'));
        });
    </script>
    
@endsection