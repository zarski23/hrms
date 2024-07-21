
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
                <div class="col-sm-6 col-md-9 col-lg-9 col-xl-9 col-12 text-right">  
                    <a href="#" class="btn btn-success" id="add_leave_credit_button" style="text-transform: none;" > <i class="fa fa-plus" aria-hidden="true"></i> Add Leave Credit Beginning Balance </a>   
                </div>  
            </div>
            <!-- /Search Filter -->

            
            <section class="review-section professional-excellence">
            <div class="review-header text-center">
                @if($name)
                    <h4 class="review-title">Name: {{ $name }}</h4>
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
                                        <td style="padding: 8px; text-align: center;">{{ $credit->late_day }}</td>
                                        <td style="padding: 8px; text-align: center;">{{ $credit->late_hours }}</td>
                                        <td style="padding: 8px; text-align: center;">{{ $credit->late_minutes }}</td>
                                        <td style="padding: 8px; text-align: center;">{{ $credit->vacation_leave_earned }}</td>
                                        <td style="padding: 8px; text-align: center;">{{ $credit->vacation_leave_deduction }}</td>
                                        <td style="padding: 8px; text-align: center;"><input style="width: 60px; padding: 0px; text-align: center; height: 30px; font-size: 14px;" type="text" class="form-control" readonly value="{{ $credit->vacation_leave_balance }}"></td>
                                        <td style="padding: 8px; text-align: center;"></td>
                                        <td style="padding: 8px; text-align: center;">{{ $credit->sick_leave_earned }}</td>
                                        <td style="padding: 8px; text-align: center;">{{ $credit->sick_leave_deduction }}</td>
                                        <td style="padding: 8px; text-align: center;"><input style="width: 60px; padding: 0px; text-align: center; height: 30px; font-size: 14px;" type="text" class="form-control" readonly value="{{ $credit->sick_leave_balance }}"></td>
                                        <td style="padding: 8px; text-align: center;">{{ $credit->remarks }}</td>
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
                                        <td style="padding: 8px;"></td>
                                        <td style="padding: 8px;" class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="btn btn-success btn-block" id="add_table_row_button" > <i class="fa fa-plus" aria-hidden="true"></i> Add Row (Month) </a>  
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
                            @endif
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Month <span class="text-danger">*</span></label>
                                        <select class="select" name="month">
                                            <option value="">Select</option>
                                            <option value="Jan">January</option>
                                            <option value="Feb">February</option>
                                            <option value="Mar">March</option>
                                            <option value="Apr">April</option>
                                            <option value="May">May</option>
                                            <option value="Jun">June</option>
                                            <option value="Jul">July</option>
                                            <option value="Aug">August</option>
                                            <option value="Sep">September</option>
                                            <option value="Oct">October</option>
                                            <option value="Nov">November</option>
                                            <option value="Dec">December</option>
                                        </select>
                                    </div>
                                </div>
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
                            <br>
                            <br>
                            <!-- <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Day</label>
                                        <input class="form-control" type="text" value="" name="day">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Hours</label>
                                        <input class="form-control" type="text" value="" name="hours">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Minutes</label>
                                        <input class="form-control" type="text" value="" name="minutes">
                                    </div>
                                </div>
                            </div>   -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Vacation Leave (Earned)</label>
                                        <input class="form-control" type="text" value="1.25" name="vacation_leave_earned">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Sick Leave (Earned)</label>
                                        <input class="form-control" type="text" value="1.25" name="sick_leave_earned">
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
                        <form action="{{ route('admin/add/table/row') }}" method="POST">
                            @csrf
                            @if($employeeDetails)
                                <input type="hidden" value="{{ $employeeDetails->id }}" name="employeeId">
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Vacation Leave (Earned)</label>
                                        <input class="form-control" type="text" value="1.25" name="vacation_leave_earned">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Sick Leave (Earned)</label>
                                        <input class="form-control" type="text" value="1.25" name="sick_leave_earned">
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
                const modal = new bootstrap.Modal(document.getElementById(modalId));
                modal.show();
            };

            addLeaveCreditButton.addEventListener('click', () => {
                if (employeeSelect.value === '') {
                    alert('Please select an employee name before proceeding.');
                } else {
                    showModal('add_leave_credit_balance');
                }
            });

            addTableRowButton.addEventListener('click', () => {
                if (employeeSelect.value === '') {
                    alert('Please select an employee name before proceeding.');
                } else {
                    showModal('add_table_row');
                }
            });
        });
    </script>

    {{-- update js --}}
    <script>
        $(document).on('click','.userUpdate',function()
        {
            var _this = $(this).parents('tr');
            $('#e_month').val(_this.find('.month').text());
            $('#e_year').val(_this.find('.year').text());
            // $('#e_time_in').val(_this.find('.time_in').text());
            // $('#e_break_out').val(_this.find('.break_out').text());
            // $('#e_break_in').val(_this.find('.break_in').text());
            // $('#e_time_out').val(_this.find('.time_out').text());
        });
    </script>


    @endsection
@endsection
