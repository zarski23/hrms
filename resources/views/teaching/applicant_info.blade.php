
@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    

    <style>
        .review-header {
            position: relative; /* Allows positioning child elements */
        }

        .download-button {
            text-transform: none;
            font-size: 0.8rem; /* Smaller font size */
            padding: 5px 10px; /* Adjust padding for a smaller button */
            position: absolute;
            right: 0; /* Aligns the button to the right */
            top: 50%; /* Vertically centers the button */
            transform: translateY(-50%); /* Adjusts for exact vertical centering */
            margin-right: 10px;
        }

       
    </style>


    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Applicant Information</h3>
                        <ul class="breadcrumb">
                            @if(session('ViewPage') == 'viewElementaryApplicants')
                                <li class="breadcrumb-item active"><a href="{{ route('elementary/applicants') }}">Assessment</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('elementary/applicants') }}">SPET Applicants</a></li>
                            @else
                                <li class="breadcrumb-item active"><a href="{{ route('elementary/applicants/done/assessment') }}">Administration</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('elementary/applicants/done/assessment') }}">SPET Applicants</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
           
            @if ($criteriaPermissionWithoutRating === 0 && $action == "Add Score")
            <section class="review-section information">
                <div class="review-header text-center" style="color: red;">
                    <br>
                    <h3>Access to the Individual Evaluation Sheet (IES) is restricted.</h3>
                    <h4>Please reach out to an authorized administrator for assistance.</h4>
                    <br>
                </div>
            </section>
            
            @else

            <!-- /For Update Info Button -->
                @if ($action == "Update Info")
                    <form action="{{ route('update/applicant/information') }}" method="POST">
                    @csrf
                        <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
                        <section class="review-section information">
                            <div class="review-header text-center">
                                <h3 class="review-title">Basic Information</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-nowrap review-table mb-0">
                                            <tbody>
                                                <tr>
                                                    <td style="border: 0;">
                                                        <div class="form-group">
                                                            <label for="application_code"><strong>Application Code:</strong></label>
                                                            <input type="text" class="form-control" id="application_code" name="application_code" value="{{ $applicant->application_code }}" readonly>
                                                        </div>
                                                    </td>
                                                    <td style="border: 0;">
                                                        <div class="form-group">
                                                            <label for="first_name"><strong>First Name:</strong></label>
                                                            <input type="text" class="form-control" name="first_name" value="{{ $applicant->first_name }}">
                                                        </div>
                                                    </td>
                                                    <td style="border: 0;">
                                                        <div class="form-group">
                                                            <label for="middle_name"><strong>Middle Name:</strong></label>
                                                            <input type="text" class="form-control" name="middle_name" value="{{ $applicant->middle_name }}">
                                                        </div>
                                                    </td>
                                                    <td style="border: 0;">
                                                        <div class="form-group">
                                                            <label for="last_name"><strong>Last Name:</strong></label>
                                                            <input type="text" class="form-control" name="last_name" value="{{ $applicant->last_name }}">
                                                        </div>
                                                    </td>
                                                    <td style="border: 0;">
                                                        <div class="form-group">
                                                            <label for="extension_name"><strong>Extension Name:</strong></label>
                                                            <input type="text" class="form-control" name="extension_name" value="{{ $applicant->extension_name }}">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="review-section information">
                            <div class="review-header text-center">
                                <h3 class="review-title">Additional Information</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-nowrap review-table mb-0">
                                            <tbody>
                                            <tr>
                                                <td style="width: 25%;">
                                                    <div class="form-group">
                                                        <label for="sex"><strong>Sex:</strong></label>
                                                        <input type="text" class="form-control" id="sex" name="sex" value="{{ $applicant->sex }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="civil_status"><strong>Civil Status:</strong></label>
                                                        <input type="text" class="form-control" id="civil_status" name="civil_status" value="{{ $applicant->civil_status }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="date_of_birth"><strong>Date of Birth:</strong></label>
                                                        <div class="cal-icon">
                                                            <input class="form-control @error('date_of_birth') is-invalid @enderror" 
                                                                type="text" 
                                                                name="date_of_birth" 
                                                                value="{{ $applicant->date_of_birth }}" 
                                                                id="date_of_birth">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="age"><strong>Age:</strong></label>
                                                        <input type="text" class="form-control" id="age" name="age" value="{{ $applicant->age }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="place_of_birth"><strong>Place of Birth:</strong></label>
                                                        <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" value="{{ $applicant->place_of_birth }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eligibility"><strong>Eligibility:</strong></label>
                                                        <input type="text" class="form-control" id="eligibility" name="eligibility" value="{{ $applicant->eligibility }}">
                                                    </div>
                                                </td>
                                                
                                                <td style="width: 25%;">
                                                    <div class="form-group">
                                                        <label for="contact_number"><strong>Contact Number:</strong></label>
                                                        <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $applicant->contact_number }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email"><strong>Email Address:</strong></label>
                                                        <input type="text" class="form-control" id="email" name="email" value="{{ $applicant->email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="religion"><strong>Religion:</strong></label>
                                                        <input type="text" class="form-control" id="religion" name="religion" value="{{ $applicant->religion }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="disability"><strong>Disability:</strong></label>
                                                        <input type="text" class="form-control" id="disability" name="disability" value="{{ $applicant->disability }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ethnic_group"><strong>Ethnic Group:</strong></label>
                                                        <input type="text" class="form-control" id="ethnic_group" name="ethnic_group" value="{{ $applicant->ethnic_group }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="beneficiary_4ps"><strong>4Ps Beneficiary:</strong></label>
                                                        <input type="text" class="form-control" id="beneficiary_4ps" name="beneficiary_4ps" value="{{ $applicant->beneficiary_4ps }}">
                                                    </div>
                                                </td>
                                                
                                                <td style="width: 50%;">
                                                    <div class="form-group">
                                                        <label for="school_name"><strong>Application For:</strong></label>
                                                        <input type="hidden" class="" id="" name="application_id" value="{{ $applicant->id }}">
                                                        <input style="text-transform: uppercase;" type="text" class="form-control" id="school_name" name="application_title" value="{{ $applicant->application_title }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="school_name"><strong>School Name:</strong></label>
                                                        <input style="text-transform: uppercase;" type="text" class="form-control" id="school_name" name="school_name" value="{{ $applicant->school_name }}">
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <label for="school_address" class="col-sm-3 col-form-label"><strong>School Address:</strong></label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <label for="school_barangay">Barangay:</label>
                                                                    <input style="text-transform: uppercase;" type="text" class="form-control" id="school_barangay" name="school_barangay" value="{{ $applicant->school_barangay }}">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="school_municipality">Municipality:</label>
                                                                    <input style="text-transform: uppercase;" type="text" class="form-control" id="school_municipality" name="school_municipality" value="{{ $applicant->school_municipality }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <hr>
                                                    <br>
                                                    <div class="form-group row">
                                                        <label for="home_address" class="col-sm-3 col-form-label"><strong>Home Address:</strong></label>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label for="barangay">Barangay:</label>
                                                                    <input style="text-transform: uppercase;" type="text" class="form-control" id="barangay" name="barangay" value="{{ $applicant->barangay }}">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label for="municipality">Municipality:</label>
                                                                    <input style="text-transform: uppercase;" type="text" class="form-control" id="municipality" name="municipality" value="{{ $applicant->municipality }}">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label for="province">Province:</label>
                                                                    <input style="text-transform: uppercase;" type="text" class="form-control" id="province" name="province" value="{{ $applicant->province }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>	 

                        <section class="review-section">
                            <div class="review-header text-center">
                                <h3 class="review-title">Education Information</h3>
                                <p class="text-muted">Input list of educational background, including degrees obtained.</p>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-review review-table mb-0" id="table_targets">
                                            <thead>
                                                <tr>
                                                    <th style="width:40px;">#</th>
                                                    <th>Baccalaureate</th>
                                                    <th>Specialization</th>
                                                    <th>Awards</th>
                                                    <th>Postgraduate Degree (if applicable)</th>
                                                    <th style="width: 64px;">
                                                        <button type="button" class="btn btn-primary btn-add-row-education"><i class="fa fa-plus"></i></button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_targets_tbody_education">
                                                @foreach ( $applicantEducation as $items)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td hidden><input type="hidden" name="education_id[]" value="{{$items->id}}"></td>
                                                        <td><input type="text" class="form-control" name="education_baccalaureate[]" value="{{$items->baccalaureate}}" ></td>
                                                        <td><input type="text" class="form-control" name="education_specialization[]" value="{{$items->specialization}}" ></td>
                                                        <td><input type="text" class="form-control" name="education_awards[]" value="{{$items->awards}}" ></td>
                                                        <td><input type="text" class="form-control" name="education_post_grad[]" value="{{$items->post_grad}}" ></td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                                                
                        <section class="review-section">
                            <div class="review-header text-center">
                                <h3 class="review-title">Training Information</h3>
                                <p class="text-muted">Please provide details of any training completed.</p>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-review review-table mb-0" id="table_targets">
                                            <thead>
                                                <tr>
                                                    <th style="width:40px;">#</th>
                                                    <th>Title</th>
                                                    <th>Hours</th>
                                                    <th>Remarks</th>
                                                    <th style="width: 64px;">
                                                        <button type="button" class="btn btn-primary btn-add-row-training"><i class="fa fa-plus"></i></button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_targets_tbody_training">
                                                @foreach ($applicantTraining as $items)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td hidden><input type="hidden" name="training_id[]" value="{{$items->id}}"></td>
                                                        <td><input type="text" class="form-control" name="training_title[]" value="{{ $items->title }}"></td>
                                                        <td><input type="text" class="form-control" name="training_hours[]" value="{{ $items->hours }}"></td>
                                                        <td><input type="text" class="form-control" name="training_remarks[]" value="{{ $items->remarks }}"></td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="review-section">
                            <div class="review-header text-center">
                                <h3 class="review-title">Experience Information</h3>
                                <p class="text-muted">Please outline relevant work experience that contributes to applicant qualifications.</p>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-review review-table mb-0" id="table_targets">
                                            <thead>
                                                <tr>
                                                <th style="width:40px;">#</th>
                                                <th>Title</th>
                                                <th>Years</th>
                                                <th>Remarks</th>
                                                <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row-experience"><i class="fa fa-plus"></i></button></th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_targets_tbody_experience">
                                                @foreach ( $applicantExperience as $items)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td hidden><input type="hidden" name="experience_id[]" value="{{$items->id}}"></td>
                                                        <td><input type="text" class="form-control" name="experience_details[]" value="{{ $items->details}}"></td>
                                                        <td><input type="text" class="form-control" name="experience_years[]" value="{{ $items->years}}" ></td>
                                                        <td><input type="text" class="form-control" name="experience_remarks[]" value="{{ $items->remarks}}"></td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="review-section" >
                            <div class="review-header text-center" style="background-color: #065e32;">
                                <div class="form-group">
                                    <h3 class="review-title" style=" color: #fff;">Application Status</h3>
                                    <select style="color: black; font-size: 20px;" 
                                            class="select @error('status') is-invalid @enderror" 
                                            name="status" 
                                            id="status" 
                                            required 
                                            onchange="updateColor(this)">
                                        <option style="color: black;" selected disabled>-- Select Status --</option>
                                        <option value="Qualified" {{ $applicant->status == 'Qualified' ? 'selected' : '' }}>Qualified</option>
                                        <option value="Disqualified" {{ $applicant->status == 'Disqualified' ? 'selected' : '' }}>Disqualified</option>
                                        <option value="Did not Attend" {{ $applicant->status == 'Did not Attend' ? 'selected' : '' }}>Did not Attend</option>
                                    </select>
                                </div>
                            </div>
                        </section>

                        <section class="review-section">
                            <div class="review-header text-center">
                                <button type="submit" class="btn btn-success submit-btn">Submit1</button>
                            </div>
                        </section>
                    </form>

                <!-- /For Add Score Button -->
                @else

                    <section class="review-section information">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-nowrap review-table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="name"><strong>Name:</strong> </label>
                                                        <input type="text" class="form-control" id="name" value="{{ $applicant->last_name }}, {{ $applicant->first_name }} {{ $applicant->middle_name }} {{ $applicant->extension_name }}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="doj"><strong>Application Code:</strong> </label>
                                                        <input type="text" class="form-control" value="{{ $applicant->application_code }}" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="doj"><strong>Position applied for: </strong></label>
                                                        <input type="text" class="form-control" id="doj" value="{{ $applicant->application_title }}" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>	 

                    <section class="review-section professional-excellence">
                        <div class="review-header text-center">
                            <h3 class="review-title">Individual Evaluation Sheet (IES)</h3>
                            <p class="text-muted">Level 2 Positions</p>
                            @if (session('withTotalRating') and session('hr_user_role') == 'Super Admin')
                                <a href="{{ url('form/download/rating') }}?application_code={{ $applicant->application_code }}" class="btn btn-success download-button" id="downloadButton" target="_blank"><i class="fa fa-download"> </i> Download File</a> 
                            @endif
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form action="{{ route('add/applicant/rating') }}" method="POST">
                                @csrf
                                <input type="text" hidden name="application_code" value="{{ $applicant->application_code }}">
                                <table class="table table-bordered review-table mb-0" style="color: black !important;">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th >Criteria</th>
                                            <th style="text-align: center;">Weight<br>Allocation</th>
                                            <th style="text-align: center;">Credit Earned</th>
                                            <th style="text-align: center;">Points</th>
                                            <th style="text-align: center;">Remarks</th>
                                            <th>Evaluator</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach ($criteriaPermissionWithoutRating as $index => $item)
                                            @if($index == 0)
                                                <tr>
                                                    <td>1 <input type="hidden" name="performance_criteria_id" value="{{ $item->id }}">
                                                    <!-- <input type="hidden" name="applicant_ratings_spet_id" value="{{ $item->applicant_ratings_spet_id }}"></td> -->
                                                    <td >Performance Rating</td>
                                                    <td style="text-align: center;">35</td>
                                                    <td>
                                                        <div>
                                                            <div style="display: flex; align-items: center; margin-bottom: 5px;">
                                                                <label style="margin-right: 5px;">Rating 1:</label>
                                                                <input type="number" name="rating1" class="form-control rating-input" style="width: 100px; height: 30px; margin: 0px;" oninput="calculatePerformance()" {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}>
                                                                <label style="margin-right: 5px;">&nbsp;&nbsp; Average :</label>
                                                                <input type="text" name="rating_average" class="form-control" style="width: 100px; height: 30px; margin: 0px;" id="averagePoints" readonly>
                                                            </div>
                                                            <div style="display: flex; align-items: center; margin-bottom: 5px;">
                                                                <label style="margin-right: 5px;">Rating 2:</label>
                                                                <input type="number" name="rating2" class="form-control rating-input" style="width: 100px; height: 30px; margin: 0px;" oninput="calculatePerformance()" {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}>
                                                            </div>
                                                            <div style="display: flex; align-items: center; margin-bottom: 5px;">
                                                                <label style="margin-right: 5px;">Rating 3:</label>
                                                                <input type="number" name="rating3" class="form-control rating-input" style="width: 100px; height: 30px; margin: 0px;" oninput="calculatePerformance()" {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="performance_criteria_points" class="form-control" style="width: 100px; text-align: center;" 
                                                            value="{{ $item->criteria_points ?? '' }}" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }} 
                                                            {{ $item->permission == 1 ? '' : 'readonly' }} id="performance_points_score"></td>
                                                    <td><input type="text" name="performance_criteria_details" class="form-control" style="text-align: center;" 
                                                            value="{{ $item->criteria_details ?? '' }}" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    </td></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            @if($index == 1)
                                                <tr>
                                                    <td>2 <input type="hidden" name="experience_criteria_id" value="{{ $item->id }}"></td>
                                                    <td >Relevant Experience</td>
                                                    <td style="text-align: center;">5</td>
                                                    <td>
                                                        <input type="text" name="experience_credit" class="form-control" oninput="calculateExperience()" id="experience_credit" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  
                                                            {{ $item->permission == 1 ? '' : 'readonly' }}>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="experience_criteria_points" class="form-control" style="width: 100px; text-align: center;" 
                                                            id="experience_points_score" 
                                                            value="{{ $item->criteria_points ?? '' }}" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  
                                                            {{ $item->permission == 1 ? '' : 'readonly' }}>
                                                    </td>
                                                    <td><input type="text" name="experience_criteria_details" class="form-control" style="text-align: center;" 
                                                            value="{{ $item->criteria_details ?? '' }}" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            @if($index == 2)
                                                <tr>
                                                    <td>3 <input type="hidden" name="outstanding_accomplishment_criteria_id" value="{{ $item->id }}"></td>
                                                    <td>Outstanding Accomplishments 	</td>
                                                    <td style="text-align: center;">20</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            @if($index == 3)
                                                <tr>
                                                    <td><input type="hidden" name="outstanding_criteria_id" value="{{ $item->id }}"></td>
                                                    <td > a.) Outstanding Employee Award</td>
                                                    <td style="text-align: center;"><i>4</i></td>
                                                    <td><select style="color: black !important; " name="outstanding_criteria_credit"  class="select @error('') is-invalid @enderror" 
                                                            id="outstanding_credit" onchange="calculateOutstanding()" {{ $item->criteria_points ? 'disabled' : '' }}  {{ $item->permission == 1 ? '' : 'disabled' }}>
                                                            <option value="0">0 - No evidence shown</option>
                                                            <option value="1">1 - Awardee in the School</option>
                                                            <option value="1">1 - Awardee in the Disctict</option>
                                                            <option value="2">2 - Awardee in the Division</option>
                                                            <option value="3">3 - Awardee in the Region</option>
                                                            <option value="4">4 - National Awardee</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="outstanding_criteria_points" style="width: 100px; text-align: center;" 
                                                            value="{{ $item->criteria_points ?? '' }}" id="outstanding_points_score"
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td><input type="text" class="form-control" name="outstanding_criteria_details" style="text-align: center;" 
                                                            value="{{ $item->criteria_details ?? '' }}" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            @if($index == 4)
                                                <tr>
                                                    <td><input type="hidden" name="innovations_criteria_id" value="{{ $item->id }}"></td>
                                                    <td > b.) Innovations</td>
                                                    <td style="text-align: center;"><i>4</i></td>
                                                    <td> <select style="color: black !important;" name="innovations_criteria_credit"  class="select @error('') is-invalid @enderror"
                                                            id="innovations_credit" onchange="calculateInnovations()" {{ $item->criteria_points ? 'disabled' : '' }}  {{ $item->permission == 1 ? '' : 'disabled' }}>
                                                            <option value="0">0 - No evidence shown</option>
                                                            <option value="1">1 - Conceptualized</option>
                                                            <option value="2">2 - Started the Implementation</option>
                                                            <option value="3">3 - Fully Implemented in the School</option>
                                                            <option value="4">4 - Adopted in the District</option>
                                                            <option value="4">4 - Adopted in the Division</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="innovations_criteria_points" style="width: 100px; text-align: center;" 
                                                            value="{{ $item->criteria_points ?? '' }}" id="innovations_points_score"
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td><input type="text" class="form-control" name="innovations_criteria_details" style="text-align: center;" 
                                                            value="{{ $item->criteria_details ?? '' }}" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            @if($index == 5)
                                                <tr>
                                                    <td><input type="hidden" name="research_criteria_id" value="{{ $item->id }}"></td>
                                                    <td > c.) Research & Development Projects</td>
                                                    <td style="text-align: center;"><i>4</i></td>
                                                    <td><select style="color: black !important;" name="research_criteria_credit" class="select @error('') is-invalid @enderror"
                                                            id="research_credit" onchange="calculateResearch()" {{ $item->criteria_points ? 'disabled' : '' }}  {{ $item->permission == 1 ? '' : 'disabled' }}>
                                                            <option value="0">0 - No evidence shown</option>
                                                            <option value="2">2 - Action research conducted in the School</option>
                                                            <option value="3">3 - Action research conducted in the District</option>
                                                            <option value="4">4 - Action research conducted in the Division</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="research_criteria_points" style="width: 100px; text-align: center;" 
                                                            value="{{ $item->criteria_points ?? '' }}" id="research_points_score"
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td><input type="text" class="form-control" name="research_criteria_details" style="text-align: center;" 
                                                            value="{{ $item->criteria_details ?? '' }}" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            @if($index == 6)
                                                <tr>
                                                    <td><input type="hidden" name="publication_criteria_id" value="{{ $item->id }}"></td>
                                                    <td > d.) Publication/ Authorship</td>
                                                    <td style="text-align: center;"><i>4</i></td>
                                                    <td><input type="text" class="form-control" name="publication_criteria_credit"  oninput="calculatePublication()" 
                                                    id="publication_credit" {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td><input type="text" class="form-control" style="width: 100px; text-align: center;" 
                                                           id="publication_points_score" name="publication_criteria_points"
                                                            value="{{ $item->criteria_points ?? '' }}" 
                                                            value="{{ $item->criteria_points ?? '' }}" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td><input type="text" class="form-control" style="text-align: center;" 
                                                            value="{{ $item->criteria_details ?? '' }}" name="publication_criteria_details"
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            @if($index == 7)
                                                <tr>
                                                    <td><input type="hidden" name="consultant_criteria_id" value="{{ $item->id }}"></td>
                                                    <td > e.) Consultant/ Resource Speaker <br>in Trainings/ Seminars</td>
                                                    <td style="text-align: center;"><i>4</i></td>
                                                    <td><select style="color: black !important;" name="consultant_criteria_credit"  class="select @error('') is-invalid @enderror"
                                                        id="consultant_credit" onchange="calculateConsultant()" {{ $item->criteria_points ? 'disabled' : '' }}  {{ $item->permission == 1 ? '' : 'disabled' }}>
                                                            <option value="0">0 - No evidence shown</option>
                                                            <option value="1">1 - District Level</option>
                                                            <option value="2">2 - Division Level</option>
                                                            <option value="3">3 - Region Level</option>
                                                            <option value="4">4 - National Level</option>
                                                            <option value="5">5 - International Level</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="consultant_criteria_points" style="width: 100px; text-align: center;" 
                                                            value="{{ $item->criteria_points ?? '' }}" id="consultant_points_score"
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td><input type="text" class="form-control" name="consultant_criteria_details" style="text-align: center;" 
                                                            value="{{ $item->criteria_details ?? '' }}" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            @if($index == 8)
                                                <tr>
                                                    <td>4 <input type="hidden" name="education_training_criteria_id" value="{{ $item->id }}"></td>
                                                    <td >Education & Training 	</td>
                                                    <td style="text-align: center;">30</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            @if($index == 9)
                                                <tr>
                                                    <td><input type="hidden" name="education_criteria_id" value="{{ $item->id }}"></td>
                                                    <td > a.) Education</td>
                                                    <td style="text-align: center;"><i>25</i></td>
                                                    <td><select style="color: black !important;" name="education_criteria_credit" class="select @error('') is-invalid @enderror"
                                                        id="education_credit" onchange="calculateEducation()" {{ $item->criteria_points ? 'disabled' : '' }}  {{ $item->permission == 1 ? '' : 'disabled' }}>
                                                            <option value="0">0 - No evidence shown</option>
                                                            <option value="10">10 - CAR for Mater's Degree</option>
                                                            <option value="15">15 - Master's Degree</option>
                                                            <option value="20">20 - CAR for Doctoral Degree</option>
                                                            <option value="25">25 - Doctoral Degree</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="education_criteria_points" style="width: 100px; text-align: center;" 
                                                            value="{{ $item->criteria_points ?? '' }}" id="education_points_score"
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td><input type="text" class="form-control" name="education_criteria_details" style="text-align: center;" 
                                                            value="{{ $item->criteria_details ?? '' }}" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            @if($index == 10)
                                                <tr>
                                                    <td><input type="hidden" name="training_criteria_id" value="{{ $item->id }}"></td>
                                                    <td > b.) Training</td>
                                                    <td style="text-align: center;"><i>5</i></td>
                                                    <td><input type="text" class="form-control" name="training_criteria_credit" oninput="calculateTraining()" 
                                                    id="training_credit" {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }} ></td>
                                                    <td><input type="text" class="form-control" name="training_criteria_points" style="width: 100px; text-align: center;" 
                                                            value="{{ $item->criteria_points ?? '' }}" id="training_points_score"
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td><input type="text" class="form-control" name="training_criteria_details" style="text-align: center;" 
                                                            value="{{ $item->criteria_details ?? '' }}" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            @if($index == 11)
                                                <tr>
                                                    <td>5 <input type="hidden" name="potential_criteria_id" value="{{ $item->id }}"></td>
                                                    <td >Potential</td>
                                                    <td style="text-align: center;">5</td>
                                                    <td><input type="text" class="form-control" name="potential_criteria_crediit" oninput="calculatePotential()" 
                                                    id="potential_credit" {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td><input type="text" class="form-control" style="width: 100px; text-align: center;" 
                                                            value="{{ $item->criteria_points ?? '' }}" id="potential_points_score" name="potential_criteria_points"
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td><input type="text" class="form-control" style="text-align: center;" 
                                                            value="{{ $item->criteria_details ?? '' }}" name="potential_criteria_details"
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            @if($index == 12)
                                                <tr>
                                                    <td>6 <input type="hidden" name="pyschosocial_criteria_id" value="{{ $item->id }}"></td>
                                                    <td >Pyschosocial Attributes & <br>Personality Traits</td>
                                                    <td style="text-align: center;">5</td>
                                                    <td><input type="text" class="form-control" name="pyschosocial_criteria_credit" oninput="calculatePyschosocial()" 
                                                    id="pyschosocial_credit" {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td><input type="text" class="form-control" name="pyschosocial_criteria_points" style="width: 100px; text-align: center;" 
                                                            value="{{ $item->criteria_points ?? '' }}" id="pyschosocial_points_score" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td><input type="text" class="form-control" name="pyschosocial_criteria_details" style="text-align: center;" 
                                                            value="{{ $item->criteria_details ?? '' }}" 
                                                            {{ $item->criteria_points ? 'readonly' : '' }}  {{ $item->permission == 1 ? '' : 'readonly' }}></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td colspan="2" class="text-center">Total</td>
                                            <td style="text-align: center;">100</td>
                                            <td></td>
                                            <td><input type="text" class="form-control" style="text-align: center; width: 100px" name="total" id="total" readonly value="{{ $totalPoints }}"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td colspan="9" style="text-align: center;">
                                                <button type="submit" class="btn btn-success submit-btn">Submit</button>
                                            </td>
                                        </tr>
                                   
                                    </tbody>
                                </table>
                                </form>

                                
                            </div>
                        </div>
                    </div>       
                    </section>

                @endif
            @endif

        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    @section('script')
    <!-- Add Table Row JS -->
    <script>
         $(function () {
            $(document).on("click", '.btn-add-row-education', function () {
                var id = $(this).closest("table.table-review").attr('id');  // Id of particular table
                var div = $("<tr />");
                div.html(GetDynamicTextBox(id));
                $("#"+id+"_tbody_education").append(div);
            });

            $(document).on("click", "#comments_remove_education", function () {
                $(this).closest("tr").remove();
            });

            function GetDynamicTextBox(table_id) {
                var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length + 1;
                return '<td>' + rowsLength + '</td>' +
                    '<td hidden><input type="hidden" name="education_id[]" class="form-control" value=""></td>' +
                    '<td><input type="text" name="education_baccalaureate[]" class="form-control" value=""></td>' +
                    '<td><input type="text" name="education_specialization[]" class="form-control" value=""></td>' +
                    '<td><input type="text" name="education_awards[]" class="form-control" value=""></td>' +
                    '<td><input type="text" name="education_post_grad[]" class="form-control" value=""></td>' +
                    '<td><button type="button" class="btn btn-danger" id="comments_remove_education"><i class="fa fa-trash-o"></i></button></td>';
            }
        });

        $(function () {
            $(document).on("click", '.btn-add-row-training', function () {
                var id = $(this).closest("table.table-review").attr('id');  // Id of particular table
                var div = $("<tr />");
                div.html(GetDynamicTextBox(id));
                $("#"+id+"_tbody_training").append(div);
            });

            $(document).on("click", "#comments_remove_training", function () {
                $(this).closest("tr").remove();
            });

            function GetDynamicTextBox(table_id) {
                var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length + 1;
                return '<td>' + rowsLength + '</td>' +
                    '<td hidden><input type="hidden" name="training_id[]" class="form-control" value=""></td>' +
                    '<td><input type="text" name="training_title[]" class="form-control" value=""></td>' +
                    '<td><input type="text" name="training_hours[]" class="form-control" value=""></td>' +
                    '<td><input type="text" name="training_remarks[]" class="form-control" value=""></td>' +
                    '<td><button type="button" class="btn btn-danger" id="comments_remove_training"><i class="fa fa-trash-o"></i></button></td>';
            }
        });

        $(function () {
            $(document).on("click", '.btn-add-row-experience', function () {
                var id = $(this).closest("table.table-review").attr('id');  // Id of particular table
                var div = $("<tr />");
                div.html(GetDynamicTextBox(id));
                $("#"+id+"_tbody_experience").append(div);
            });

            $(document).on("click", "#comments_remove_experience", function () {
                $(this).closest("tr").remove();
            });

            function GetDynamicTextBox(table_id) {
                var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length + 1;
                return '<td>' + rowsLength + '</td>' +
                    '<td hidden><input type="hidden" name="experience_id[]" class="form-control" value=""></td>' +
                    '<td><input type="text" name="experience_details[]" class="form-control" value=""></td>' +
                    '<td><input type="text" name="experience_years[]" class="form-control" value=""></td>' +
                    '<td><input type="text" name="experience_remarks[]" class="form-control" value=""></td>' +
                    '<td><button type="button" class="btn btn-danger" id="comments_remove_experience"><i class="fa fa-trash-o"></i></button></td>';
            }
        });

        $(function () {
            $(document).on("click", '.btn-add-row', function () {
                var id = $(this).closest("table.table-review").attr('id');  // Id of particular table
                console.log(id);
                var div = $("<tr />");
                div.html(GetDynamicTextBox(id));
                $("#"+id+"_tbody").append(div);
            });
            $(document).on("click", "#comments_remove", function () {
                $(this).closest("tr").prev().find('td:last-child').html('<button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button>');
                $(this).closest("tr").remove();
            });
            function GetDynamicTextBox(table_id) {
                $('#comments_remove').remove();
                var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length+1;
                return '<td>'+rowsLength+'</td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>'
            }
        });
    </script>

    <script>

        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            // When the checkbox is clicked, call the toggleReadonly function
            checkbox.addEventListener('click', function() {
                toggleReadonly(this);
            });

            // Handle label clicks as well
            const label = checkbox.parentElement;
            label.addEventListener('click', function() {
                checkbox.checked = !checkbox.checked;
                toggleReadonly(checkbox);
            });
        });


        function calculatePoints(criteriaID) {
            const incInputElement = document.getElementById(`criteria_${criteriaID}_inc`);
            const incInput = incInputElement.value;
            let score = 0;

            if (incInput === "") {
                document.getElementById(`criteria_${criteriaID}_points`).value = "";
                return;
            }

            const key = event.data;
            if (key === null) {
                return;
            }

            // Check if the last character is not a digit
            if (!/^\d*\.?\d*$/.test(incInput)) {
                alert("Please enter a valid number.");
                incInputElement.value = incInput.slice(0, -1); // Remove the last character
                return;
            }

            const inc = parseFloat(incInputElement.value);

            
            if (criteriaID == 2 || criteriaID == 11 || criteriaID == 12 || criteriaID == 13 ){
                score = inc;
                if (score > 5){
                    score = 5;
                }
            }
            else if (criteriaID == 4 || criteriaID == 5 || criteriaID == 6 || criteriaID == 7 || criteriaID == 8) {
                score = inc;
                if (score > 4){
                    score = 4;
                }
            }
            else if (criteriaID == 10){
                score = inc;
                if (score > 25){
                    score = 25;
                }
            }

            document.getElementById(`criteria_${criteriaID}_points`).value = formatNumber(score);
            
        }

    </script>

    
    <script>

        function calculatePerformance () {
            const inputs = document.querySelectorAll('.rating-input');
            let total = 0;
            let count = 0;

            inputs.forEach(input => {
                // Only add the value if it's not empty
                const value = input.value.trim() !== '' ? parseFloat(input.value) : 0; 
                total += value;
                if (input.value.trim() !== '') {
                    count++; // Count non-empty values
                }
            });

            // Calculate the average
            const average = count > 0 ? (total / count).toFixed(3) : 0; // Round to 2 decimal places

            // Update the averagePoints input with the calculated average
            document.getElementById('averagePoints').value = average;


            score = (average * 20) * .35;

            if (score > 35){
                score = 35;
            }
            
            document.getElementById('performance_points_score').value = score;
            sumPointsScores();
        }

        function calculateExperience() {
            
            let criteriaPointsValue = document.getElementById('experience_credit').value;

            if(criteriaPointsValue > 5){
                criteriaPointsValue = 5;
            }
            
            document.getElementById('experience_points_score').value = criteriaPointsValue;
            sumPointsScores();
        }

        function calculateOutstanding () {
            
            const selectValue = document.getElementById('outstanding_credit').value;
            document.getElementById('outstanding_points_score').value = selectValue;
            sumPointsScores();

        }

        function calculateInnovations () {
            
            const selectValue = document.getElementById('innovations_credit').value;
            document.getElementById('innovations_points_score').value = selectValue;
            sumPointsScores();

        }

        function calculateResearch () {
            
            const selectValue = document.getElementById('research_credit').value;
            document.getElementById('research_points_score').value = selectValue;
            sumPointsScores();

        }

        function calculatePublication() {
            
            let criteriaPointsValue = document.getElementById('publication_credit').value;

            if(criteriaPointsValue > 5){
                criteriaPointsValue = 5;
            }
            
            document.getElementById('publication_points_score').value = criteriaPointsValue;
            sumPointsScores();
        }

        function calculateConsultant () {
            
            const selectValue = document.getElementById('consultant_credit').value;
            document.getElementById('consultant_points_score').value = selectValue;
            sumPointsScores();

        }

        function calculateEducation() {
            const selectValue = parseFloat(document.getElementById('education_credit').value) || 0;
            document.getElementById('education_points_score').value = selectValue;
            sumPointsScores();
        }

        function calculateTraining() {
            
            let criteriaPointsValue = document.getElementById('training_credit').value;

            if(criteriaPointsValue > 5){
                criteriaPointsValue = 5;
            }
            
            document.getElementById('training_points_score').value = criteriaPointsValue;
            sumPointsScores();
        }

        function calculatePotential() {
            
            let criteriaPointsValue = document.getElementById('potential_credit').value;

            if(criteriaPointsValue > 5){
                criteriaPointsValue = 5;
            }
            
            document.getElementById('potential_points_score').value = criteriaPointsValue;
            sumPointsScores();
        }

        function calculatePyschosocial () {
            
            let result = document.getElementById('pyschosocial_credit').value;

            criteriaPointsValue = result * 0.2;
            
            if(criteriaPointsValue > 5){
                criteriaPointsValue = 5;
            }
            
            document.getElementById('pyschosocial_points_score').value = criteriaPointsValue.toFixed(3);
            sumPointsScores();
        }

        function sumPointsScores() {
            const scores = document.querySelectorAll('input[id$="_points_score"]');
            let total = 0;
            scores.forEach(input => {
                const value = parseFloat(input.value) || 0; // Convert to number, default to 0
                total += value;
            });
            document.getElementById('total').value = total; // Display total in an input with ID 'totalPointsScore'
        }

    </script>

    @endsection
@endsection
