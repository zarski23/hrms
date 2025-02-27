
@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Leave Credits</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Payroll</a></li>
                            <li class="breadcrumb-item active">Leave Credits</li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <a href="{{ route('view/leave/credits') }}" class="btn btn-info btn-block"> Refresh </a>  
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-12">  
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="employee_select"> 
                            <option value=""> -- Select -- </option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->user_id }}" @if($selectedEmployeeId == $employee->user_id) selected @endif>{{ $employee->last_name }}, {{ $employee->first_name }} {{ $employee->middle_name }}</option>
                            @endforeach
                        </select>
                        <label class="focus-label">Employee Name</label>
                    </div>
                </div>
                
            </div>
            <!-- /Search Filter -->

            
            <section class="review-section professional-excellence">
            <div class="review-header text-center">
                @if($name)
                    <h4 class="review-title">Name: {{ $name }}</h4>
                    <h4 class="review-title">DTR ID: {{ $dtr_id }}</h4>
                @else
                    <h4 class="review-title">Name: --------, -------- .</h4>
                @endif
                <p class="text-muted">Year : <span id="year"></span></p>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table table-bordered review-table mb-0" style="font-size: 14px">
                                <thead>
                                    <tr>
                                        <!-- <th>Sort</th> -->
                                        <th colspan="2" style="text-align: center; height: 10px;"></th>
                                        <th colspan="3" style="text-align: center; height: 10px;">Particular</th>
                                        <th colspan="4" style="text-align: center; height: 10px;">Vacation Leave</th>
                                        <th colspan="4" style="text-align: center; height: 10px;">Sick Leave</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <!-- <th>Sort</th> -->
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Day</th>
                                        <th>Hours</th>
                                        <th>Mins</th>
                                        <th>Earned</th>
                                        <th style="font-size: 12px;">ABS UND. <br>( W/PAY )</th>
                                        <th style="font-size: 12px;">BALANCE</th>
                                        <th style="font-size: 12px;">ABS UND. <br>( W/O PAY )</th>
                                        <th>Earned</th>
                                        <th style="font-size: 12px;">ABS UND. <br>( W/PAY )</th>
                                        <th style="font-size: 12px;">BALANCE</th>
                                        <th style="font-size: 12px;">ABS UND. <br>( W/O PAY )</th>
                                        <th style="font-size: 12px; text-align: center; width: 60px;">TOTAL <br> BALANCE</th>
                                        <th style="font-size: 13px; text-align: center;">Date and Action on <br>Applying for Leave</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Iterate over each row of the table -->
                                    @foreach($employeeLeaveCredits as $credit)
                                    <tr>
                                        <!-- <td>{{ $credit->id }}</td> -->
                                        <td class="month" style="padding: 8px; text-align: center;">{{ $credit->month }}</td>
                                        <td class="year" style="padding: 8px; text-align: center;">{{ $credit->year }}</td>
                                        <td class="day" style="padding: 8px; text-align: center;">{{ $credit->late_day }}</td>
                                        <td class="hours" style="padding: 8px; text-align: center;">{{ $credit->late_hours }}</td>
                                        <td class="minutes" style="padding: 8px; text-align: center;">{{ $credit->late_minutes }}</td>
                                        <td class="vacation_leave_earned" style="padding: 8px; text-align: center;">{{ $credit->vacation_leave_earned }}</td>
                                        <td class="vacation_leave_deduction" style="padding: 8px; text-align: center;">{{ $credit->vacation_leave_deduction }}</td>
                                        <td style="padding: 8px; text-align: center;"><input style="width: 60px; padding: 0px; text-align: center; height: 30px; font-size: 14px;" type="text" class="form-control" readonly value="{{ $credit->vacation_leave_balance }}"></td>
                                        <td style="padding: 8px; text-align: center;"></td>
                                        <td class="sick_leave_earned" style="padding: 8px; text-align: center;">{{ $credit->sick_leave_earned }}</td>
                                        <td class="sick_leave_deduction" style="padding: 8px; text-align: center;">{{ $credit->sick_leave_deduction }}</td>
                                        <td style="padding: 8px; text-align: center;"><input style="width: 60px; padding: 0px; text-align: center; height: 30px; font-size: 14px;" type="text" class="form-control" readonly value="{{ $credit->sick_leave_balance }}"></td>
                                        <td class="remarks" style="padding: 8px; text-align: center;">{{ $credit->remarks }}</td>
                                        <td style="padding: 8px; text-align: center;"><input style="width: 60px; padding: 0px; text-align: center; height: 30px; font-size: 14px;" type="text" class="form-control" readonly value="{{ $credit->total_leave_balance }}"></td>
                                        <td style="padding: 8px; text-align: center;"></td>
                                        <td style="padding: 8px;" class="text-center">
                                            <div class="dropdown dropdown-action"style="width: 70px;">
                                                <a style="padding: 5px;" class="dropdown-item userUpdate" data-toggle="modal" data-id="'.$result->user_id.'" data-target="#update_table_row"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" style="text-align: center;">Total Leave Credits</td>
                                        <td style="padding: 8px;"></td>
                                        <td style="padding: 8px;"></td>
                                        <td style="padding: 8px;"><input style="width: 60px; padding: 0px; text-align: center; height: 30px; font-size: 14px;" type="text" class="form-control" readonly value="{{ $totalVLBalance }}"></td>
                                        <td style="padding: 8px;"></td>
                                        <td style="padding: 8px;"></td>
                                        <td style="padding: 8px;"></td>
                                        <td style="padding: 8px;"><input style="width: 60px; padding: 0px; text-align: center; height: 30px; font-size: 14px;" type="text" class="form-control" readonly value="{{ $totalSLBalance }}"></td>
                                        <td style="padding: 8px;"></td>
                                        <td style="padding: 8px;"><input style="width: 60px; padding: 0px; text-align: center; height: 30px; font-size: 14px;" type="text" class="form-control" readonly value="{{ $totalLeaveBalance }}"></td>
                                        <td style="padding: 8px;"></td>
                                        <td style="padding: 8px;" class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                            @if($employeeLeaveCredits->isNotEmpty())
                                <a href="#" class="btn btn-success btn-block" id="add_table_row_button" > <i class="fa fa-plus" aria-hidden="true"></i> Add Row (Month) </a>  
                            @else
                                <a href="#" class="btn btn-info btn-block" id="add_leave_credit_button"> <i class="fa fa-plus" aria-hidden="true"></i> Add Leave Credit Beginning Balance </a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

        <!--  ADD Leave Credit Beginning Balance -->
        <div id="add_leave_credit_balance" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Add Leave Credit Beginning Balance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/add/leave/credits/beginning/balance') }}" method="POST">
                            @csrf
                            @if($employeeDetails)
                                <input type="hidden" value="{{ $employeeDetails->id }}" name="employeeId">
                                <input type="hidden" value="{{ $dtr_id }}" name="dtr_id">
                            @endif
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Year <span class="text-danger">*</span></label>
                                        <select class="select" name="year">
                                            <option value="">Select</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Vacation Leave (Beginning Balance)</label>
                                        <input class="form-control" type="text" name="vacation_leave_earned_begginning_balance">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Sick Leave (Beginning Balance)</label>
                                        <input class="form-control" type="text" name="sick_leave_earned_begginning_balance">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="submit-section">
                                <button class="btn btn-success submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- / ADD Leave Credit Beginning Balance -->

        <!-- Add Table Row -->
        <div id="add_table_row" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Table Row (Month)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/add/table/row') }}" method="POST">
                            @csrf
                            @if($employeeDetails)
                                <input type="hidden" value="{{ $employeeDetails->id }}" name="employeeId">
                                <input type="hidden" value="{{ $dtr_id }}" name="dtr_id">
                            @endif
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Month <span class="text-danger">*</span></label>
                                        <select class="select" name="month" id="month-select">
                                            <option value="">Select</option>
                                            @foreach ($uniqueMonths as $month)
                                                @php
                                                    $dateObj = DateTime::createFromFormat('M', $month);
                                                    $fullMonthName = $dateObj->format('F');
                                                @endphp
                                                <option value="{{ $month }}">{{ $fullMonthName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Year <span class="text-danger">*</span></label>
                                        <select class="select" name="year" id="year-select">
                                            <option value="">Select</option>
                                                @foreach ($uniqueYears as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Day</label>
                                        <input class="form-control" type="text" value="" name="day" id="day-input">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Hours</label>
                                        <input class="form-control" type="text" value="" name="hours" id="hours-input">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Minutes</label>
                                        <input class="form-control" type="text" value="" name="minutes" id="minutes-input">
                                    </div>
                                </div>
                            </div>  
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Vacation Leave (Earned)</label>
                                        <input class="form-control" type="text" value="1.25" name="vacation_leave_earned" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Sick Leave (Earned)</label>
                                        <input class="form-control" type="text" value="1.25" name="sick_leave_earned" readonly>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="submit-section">
                                <button class="btn btn-success submit-btn">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Table Row -->

        <!-- Hidden Inputs For Modal Add Row Data -->
        @foreach($employeesLeaveCreditfromAttendance as $result)
            <input type="hidden" id="total_absent_days_{{ $result->year }}_{{ $result->month }}" value="{{ $result->total_absent_days }}">
            <input type="hidden" id="total_late_hours_{{ $result->year }}_{{ $result->month }}" value="{{ $result->total_late_hours }}">
            <input type="hidden" id="total_late_remaining_minutes_{{ $result->year }}_{{ $result->month }}" value="{{ $result->total_late_remaining_minutes }}">
        @endforeach

        <!-- Update Table Row -->
        <div id="update_table_row" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Leave Credits</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/update/table/row') }}" method="POST">
                            @csrf
                            @if($employeeDetails)
                                <input type="text" value="{{ $employeeDetails->id }}" name="employeeId">
                            @endif
                           
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Month <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" value="" name="month" id="e_month" readonly>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Year <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" value="" name="year" id="e_year" readonly>
                                    </div>
                                </div>
                            </div>
                                <hr>
                                <p>Vacantion Leave</p>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Day</label>
                                            <input class="form-control" type="text" value="" name="day" id="e_day">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Hours</label>
                                            <input class="form-control" type="text" value="" name="hours" id="e_hours">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Minutes</label>
                                            <input class="form-control" type="text" value="" name="minutes" id="e_minutes">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Deduction</label>
                                            <input class="form-control" type="text" value="" name="vacation_leave_deduction" id="e_vacation_leave_deduction">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Vacation Leave (Earned)</label>
                                            <input class="form-control" type="text" value="" name="vacation_leave_earned" id="e_vacation_leave_earned">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p>Sick Leave</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Deduction</label>
                                            <input class="form-control" type="text" value="" name="sick_leave_deduction" id="e_sick_leave_deduction">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Sick Leave (Earned)</label>
                                            <input class="form-control" type="text" value="" name="sick_leave_earned" id="e_sick_leave_earned">
                                        </div>
                                     </div>
                                </div>  
                                <hr>
                                <p>Date and Action on Applying for Leave:</p>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea class="form-control" type="text" value="" name="remarks" id="e_remarks"></textarea>
                                        </div>
                                     </div>
                                </div>  
                            <div class="submit-section">
                                <button class="btn btn-success submit-btn">Confirm</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Update Table Row -->

        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    @section('script')

    <script>
        document.getElementById("year").innerHTML = new Date().getFullYear();
    </script>

    <!-- For Add Table Row -->
    <script>
        $(document).ready(function () {
            const updateInputs = function () {
                const selectedMonth = $('#month-select').val();
                const selectedYear = $('#year-select').val();

                if (selectedMonth && selectedYear) {
                    const totalAbsentDays = $(`#total_absent_days_${selectedYear}_${selectedMonth}`).val() || '';
                    const totalLateHours = $(`#total_late_hours_${selectedYear}_${selectedMonth}`).val() || '';
                    const totalLateMinutes = $(`#total_late_remaining_minutes_${selectedYear}_${selectedMonth}`).val() || '';

                    $('#day-input').val(totalAbsentDays);
                    $('#hours-input').val(totalLateHours);
                    $('#minutes-input').val(totalLateMinutes);
                } else {
                    $('#day-input').val('');
                    $('#hours-input').val('');
                    $('#minutes-input').val('');
                }
            };

            $('#month-select, #year-select').on('change', updateInputs);
        });
    </script>

    <!-- Add Table Row JS -->
    <script>
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

    <!-- When Selecting employee name --> 
    <script>
        $(document).ready(function() {
            // Get the employee ID from the URL parameter
            var urlParams = new URLSearchParams(window.location.search);
            var employeeid = urlParams.get('employeeid');

            // Set the selected option in the dropdown list
            if (employeeid) {
                $('#employee_select').val(employeeid);
            }

            // Handle change event on dropdown list
            $('#employee_select').on('change', function() {
                var selectedEmployeeId = $(this).val();
                if (selectedEmployeeId) {
                    window.location.href = '/view/employee/leave/credits/' + selectedEmployeeId + '?employeeid=' + selectedEmployeeId;
                }
            });
        });
    </script>
    
    <!-- Validation -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const employeeSelect = document.getElementById('employee_select');
            const addLeaveCreditButton = document.getElementById('add_leave_credit_button');
            const addTableRowButton = document.getElementById('add_table_row_button');

            const showModal = (modalId) => {
                const modalElement = document.getElementById(modalId);
                if (modalElement) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }
            };

            if (addLeaveCreditButton) {
                addLeaveCreditButton.addEventListener('click', () => {
                    if (employeeSelect.value === '') {
                        alert('Please select an employee name before proceeding.');
                    } else {
                        showModal('add_leave_credit_balance');
                    }
                });
            }

            if (addTableRowButton) {
                addTableRowButton.addEventListener('click', () => {
                    if (employeeSelect.value === '') {
                        alert('Please select an employee name before proceeding.');
                    } else {
                        showModal('add_table_row');
                    }
                });
            }
        });

    </script>

    {{-- update js --}}
    <script>
        $(document).on('click','.userUpdate',function()
        {
            var _this = $(this).parents('tr');
            $('#e_month').val(_this.find('.month').text());
            $('#e_year').val(_this.find('.year').text());
            $('#e_day').val(_this.find('.day').text());
            $('#e_hours').val(_this.find('.hours').text());
            $('#e_minutes').val(_this.find('.minutes').text());
            $('#e_vacation_leave_earned').val(_this.find('.vacation_leave_earned').text());
            $('#e_sick_leave_earned').val(_this.find('.sick_leave_earned').text());
            $('#e_vacation_leave_deduction').val(_this.find('.vacation_leave_deduction').text());
            $('#e_sick_leave_deduction').val(_this.find('.sick_leave_deduction').text());
            $('#e_remarks').val(_this.find('.remarks').text());
        });
    </script>


    @endsection
@endsection
