
@extends('layouts.master')
@section('content')
   
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Work Schedules</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Work Schedules</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_department"><i class="fa fa-plus"></i> Add Work Schedules</a>
                    </div>
                </div>
            </div>

            <!-- /Page Header -->
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">#</th>
                                    <th>Shift Type</th>
                                    <th>Start Day</th>
                                    <th>End Day</th>
                                    <th>Time-In</th>
                                    <th>Break-out Time</th>
                                    <th>Break-in Time</th>
                                    <th>Time-out</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($workingSchedules as $key=>$items )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td hidden class="id">{{ $items->id }}</td>
                                    <td class="department">{{ $items->shift_type }}</td>
                                    <td class="department">{{ $items->start_day }}</td>
                                    <td class="department">{{ $items->end_day }}</td>
                                    <td class="department">{{ $items->start_time }}</td>
                                    <td class="department">{{ $items->break_out_time }}</td>
                                    <td class="department">{{ $items->break_in_time }}</td>
                                    <td class="department">{{ $items->end_time }}</td>
                                    <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item  edit_department" href="#" data-toggle="modal" data-target="#edit_department"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item delete_department" href="#" data-toggle="modal" data-target="#delete_department"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        
        <!-- Add Department Modal -->
        <div id="add_department" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Work Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/add/work/schedule/list') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                <input type="hidden" class="form-control" name="schedule_id" value="" readonly>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Shift type <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="shift_type" name="shift_type">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Start day <span class="text-danger">*</span></label>
                                                <select class="select form-control @error('start_day') is-invalid @enderror" name="start_day">
                                                    <option value="Mon">Monday</option>
                                                    <option value="Tue">Tuesday</option>
                                                    <option value="Wed">Wednesday</option>
                                                    <option value="Thu">Thursday</option>
                                                    <option value="Fri">Friday</option>
                                                    <option value="Sat">Saturday</option>
                                                    <option value="Sun">Sunday</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>End day <span class="text-danger">*</span></label>
                                                <select class="select form-control @error('end_day') is-invalid @enderror" name="end_day">
                                                    <option value="Mon">Monday</option>
                                                    <option value="Tue">Tuesday</option>
                                                    <option value="Wed">Wednesday</option>
                                                    <option value="Thu">Thursday</option>
                                                    <option value="Fri">Friday</option>
                                                    <option value="Sat">Saturday</option>
                                                    <option value="Sun">Sunday</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Time-in <span class="text-danger"><small>*24hrs format</small></span></label>
                                                <select id="timeSelect_start_time" class="select form-control @error('start_time') is-invalid @enderror" name="start_time">
                                                    <option value="" disabled selected>Select a time</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Break-out  <span class="text-danger"><small>*24hrs format</small></span></label>
                                                <select id="timeSelect_break_out_time" class="select form-control @error('break_out_time') is-invalid @enderror" name="break_out_time">
                                                    <option value="-"  selected>Select Break out</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Break-in <span class="text-danger"><small>*24hrs format</small></span></label>
                                                <select id="timeSelect_break_in_time" class="select form-control @error('break_in_time') is-invalid @enderror" name="break_in_time">
                                                    <option value="-"  selected>Select Break in</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Time-out  <span class="text-danger"><small>*24hrs format</small></span></label>
                                                <select id="timeSelect_end_time" class="select form-control @error('end_time') is-invalid @enderror" name="end_time">
                                                    <option value="" disabled selected>Select a time</option>
                                                </select>
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
        <!-- /Add Department Modal -->
        
        <!-- Edit Department Modal -->
        <div id="edit_department" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Work Schedule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="form-group">
                                <label>Department Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="department_edit" name="department" value="">
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Department Modal -->



        <!-- Delete Department Modal -->
        <div class="modal custom-modal fade" id="delete_department" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Department</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Department Modal -->
    </div>

    <!-- /Page Wrapper -->
    @section('script')
    {{-- update js --}}
    <script>
        $(document).on('click','.edit_department',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#department_edit').val(_this.find('.department').text());
        });
    </script>
    {{-- delete model --}}
    <script>
        $(document).on('click','.delete_department',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>

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

    @endsection
@endsection
