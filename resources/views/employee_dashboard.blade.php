@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">My Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Main</a></li>
                            <li class="breadcrumb-item active">My Profile</li>
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
                                            <img alt="" src="{{ URL::to('/assets/images/'.Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ Session::get('first_name') }} {{ Session::get('middle_name') }} {{ Session::get('last_name') }}</h3>
                                                <div class="staff-id">Employee ID : {{ Session::get('employee_id') }}</div>
                                                <div class="small doj text-muted">Date Hired : {{ Session::get('date_hired') }}</div>
                                                <div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send Message</a></div>
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
                            
                            <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Salary and Taxes <small class="text-danger">(Authorized Admin Only)</small></a></li>
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
                                    <h3 class="card-title">Work Schedule</h3>
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

                </div>
                <!-- /Profile Info Tab -->
                
                <!-- Basic Salary Information Tab -->
                <div class="tab-pane fade" id="bank_statutory">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"> Basic Salary Information</h3>
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
                                <h3 class="card-title"> Community Tax Information</h3>
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
        <!-- Profile Modal -->
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
                        <form action="{{ route('profile/information/save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <div class="col-md-12" style="text-align: center;">
                                        <div class="form-group">
                                            <h4 class="user-name m-t-0 mb-0"> Name : {{ Session::get('first_name') }} {{ Session::get('middle_name') }} {{ Session::get('last_name') }}</h4>
                                            <br>
                                            <h4 class="user-name m-t-0 mb-0"> Employee ID : {{ Session::get('employee_id') }}</h4>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="profile-img-wrap edit-img">
                                        <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="{{ Auth::user()->employee_id }}">
                                        <img class="inline-block" src="{{ URL::to('/assets/images/'. Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
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

                                    <!-- @if (Auth::user()->hr_user_role=='Admin' || Auth::user()->hr_user_role=='admin')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="text" disabled class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Position</label>
                                                <select name="employee_position" class="form-control">
                                                    <option style="color: white; background-color: gray;" value="{{ $employeeProfile->position_name }}" {{ ( $employeeProfile->position_name == $employeeProfile->position_name) ? 'selected' : '' }}> {{ $employeeProfile->position_name }} </option>
                                                    @foreach ($employeePositions as $key=>$employeePosition )
                                                    <option value="{{ $employeePosition->position_name }}">{{ $employeePosition->position_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select name="employee_pdepartment" class="form-control">
                                                    <option style="color: white; background-color: gray;" value="{{ $employeeProfile->department_name }}" {{ ( $employeeProfile->department_name == $employeeProfile->department_name) ? 'selected' : '' }}> {{ $employeeProfile->department_name }} </option>
                                                    @foreach ($employeeDepartment as $key=>$department )
                                                    <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <select name="employmentType" class="form-control">
                                                    <option style="color: white; background-color: gray;" value="{{ $employeeProfile->employment_type }}" {{ ( $employeeProfile->employment_type == $employeeProfile->employment_type) ? 'selected' : '' }}> {{ $employeeProfile->employment_type }} </option>
                                                    @foreach ($employmentType as $key=>$employmentType )
                                                    <option value="{{ $employmentType->employment_type }}">{{ $employmentType->employment_type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endif -->

                                </div>
                            </div>
                            
                            <div class="submit-section">
                                <button type="submit" class="btn btn-success submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Profile Modal -->
        @else
        <!-- Profile Modal -->
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
                        <form action="{{ route('profile/information/save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    @if (Auth::user()->hr_user_role=='Employee' || Auth::user()->hr_user_role=='employee')
                                        <div class="col-md-12" style="text-align: center;">
                                            <div class="form-group">
                                                <h4 class="user-name m-t-0 mb-0"> Name : {{ Session::get('first_name') }} {{ Session::get('middle_name') }} {{ Session::get('last_name') }}</h4>
                                                <br>
                                                <h4 class="user-name m-t-0 mb-0"> Employee ID : {{ Session::get('employee_id') }}</h4>
                                            </div>
                                        </div>
                                        <br>
                                    @endif

                                    <div class="profile-img-wrap edit-img">
                                        <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="{{ Auth::user()->employee_id }}">
                                        <img class="inline-block" src="{{ URL::to('/assets/images/'. Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
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

                                    @if (Auth::user()->hr_user_role=='Admin' || Auth::user()->hr_user_role=='admin')
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->first_name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Middle Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->middle_name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->last_name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Position</label>
                                                <select name="employee_position" class="form-control">
                                                    <option value="">--- Please select Employee Position ---</option>
                                                    @foreach ($employeePositions as $key=>$employeePosition )
                                                    <option value="{{ $employeePosition->position_name }}">{{ $employeePosition->position_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select name="employee_pdepartment" class="form-control">
                                                    <option value="">--- Please select Employee Department ---</option>
                                                    @foreach ($employeeDepartment as $key=>$department )
                                                    <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Designation</label>
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
                                                <label>Status</label>
                                                <select class="select form-control" id="employeeStatus" name="employeeStatus">
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /Profile Modal -->
        @endif
    
        @if (!empty($employeeInformation))
        
        <!-- Personal Info Modal -->
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
                        <form action="{{ route('employee/information/save') }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" name="user_id" value="{{ Session::get('user_id') }}" readonly>
                            <input type="hidden" class="form-control" name="employee_id" value="{{ Session::get('employee_id') }}" readonly>
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
                                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ $user->email }}">
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
                                <button type="submit" class="btn btn-success submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Personal Info Modal -->
        @else
         <!-- Personal Info Modal -->
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
                        <form action="{{ route('employee/information/save') }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" name="user_id" value="{{ Session::get('user_id') }}" readonly>
                            <input type="hidden" class="form-control" name="employee_id" value="{{ Session::get('employee_id') }}" readonly>
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
                                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email">
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
        <!-- /Personal Info Modal -->
        @endif
        
        <!-- Emergency Contact Modal -->
        <div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Emergency Contact Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Primary Contact</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control">
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
                                                <label>Phone <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone 2</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Primary Contact</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control">
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
                                                <label>Phone <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone 2</label>
                                                <input class="form-control" type="text">
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
        <!-- /Emergency Contact Modal -->
        
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
@endsection