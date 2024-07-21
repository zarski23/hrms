
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
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Attendance Report <span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">HR Administration</a></li>
                            <li class="breadcrumb-item active">Payroll</li>
                        </ul>
                    </div>
                </div>
            </div>
             <!-- Search Filter -->
             <form action="" method="POST">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="name" name="name" onkeyup="search()">
                            <label class="focus-label">Search Here</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <button type="sumit" class="btn btn-info btn-block"> Refresh </button>  
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <a href="#" style="text-transform:none;" class="btn btn-success btn-block" data-toggle="modal" data-target="#add_salary"><i class="fa fa-file"></i> Upload Excel File</a> 
                    </div>    
                </div>
            </form>     
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="employee_table" class="table table-striped custom-table datatable"  style="font-size: 14px !important;">
                            <thead>
                                <tr>
                                    <th hidden>Year and Date</th>
                                    <th hidden>User ID</th>
                                    <th>Employee</th>
                                    <th>Designation</th>
                                    <th>Year</th>
                                    <th>Date</th>
                                    <th>Week</th>
                                    <th>Work Schedule</th>
                                    <th>Time in</th>
                                    <th>Break out</th>
                                    <th>Break in</th>
                                    <th>Time out</th>
                                    <th class="text-center">days</th>
                                    <th style="color: red; text-align: center;">Late (Mins.)</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendance as $record)
                                <tr>
                                    <td hidden>{{ $record->year }}{{ $record->date }}</td>
                                    <td class="dtr_id" hidden>{{ $record->dtr_id }}</td>
                                    <td class="name">{{ $record->first_name }} {{ $record->middle_name }} {{ $record->last_name }}</td>
                                    <td>{{ $record->employment_type }}</td>
                                    <td class="dtr_year">{{ $record->year }}</td>
                                    <td class="dtr_date">{{ $record->date }}</td>
                                    <td>{{ $record->week }}</td>
                                    <td>---</td>
                                    <td class="time_in">{{ $record->time_in }}</td>
                                    <td class="break_out">{{ $record->break_out }}</td>
                                    <td class="break_in">{{ $record->break_in }}</td>
                                    <td class="time_out">{{ $record->time_out }}</td>
                                    <td class="text-center">{{ $record->days_worked }}</td>
                                    <td style="color: red; text-align: center;">{{ $record->late }}</td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown-action">
                                            <a class="dropdown-item userUpdate" data-toggle="modal" data-id="'.$result->user_id.'" data-target="#edit_attendance"><i class="fa fa-pencil m-r-5"></i> Edit</a>
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
       

        <!-- Upload File Modal -->
        <div id="add_salary" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Attendance Report</h5>                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                        
                    </div>
                    <div class="modal-body">
                        <form action="{{route('upload/attendance/report')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div> 
                                <!-- <input class="form-control" type="hidden" name="user_id" id="employee_id" readonly> -->
                                <div>
                                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="file">
                                </div>
                            
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Upload File Modal -->
        
        <!-- Edit Attendance Modal -->
        <div id="edit_attendance" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Employee Attendance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin/edit/employee/attendance') }}" method="POST">
                            @csrf
                            <input class="form-control" type="hidden" name="dtr_id" id="e_dtr_id" value="" readonly>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control " type="text" name="name" id="e_name" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Date</label>
                                    <input class="form-control" type="text" name="date" id="e_date" value="" readonly>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    
                                    <div class="form-group">
                                        <label>Time in:</label>
                                        <input class="form-control" type="text" name="time_in" id="e_time_in" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Break in:</label>
                                        <input class="form-control" type="text"  name="break_in" id="e_break_in" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6">  
                                    
                                    <div class="form-group">
                                        <label>Break out:</label>
                                        <input class="form-control" type="text" name="break_out" id="e_break_out" value="">
                                    </div> 
                                    <div class="form-group">
                                        <label>Time out:</label>
                                        <input class="form-control" type="text" name="time_out" id="e_time_out" value="">
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
        <!-- /Edit Attendance Modal -->
        
        <!-- Delete Salary Modal -->
        <!-- <div class="modal custom-modal fade" id="delete_salary" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Salary</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <input type="hidden" name="id" class="e_id" value="">
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
        </div> -->
        <!-- /Delete Salary Modal -->
     
    </div>
    <!-- /Page Wrapper -->
    @section('script')
        <script>
            $(document).ready(function() {
                $('.select2s-hidden-accessible').select2({
                    closeOnSelect: false
                });
            });
        </script>
        <script>
            // select auto id and email
            $('#name').on('change',function()
            {
                $('#employee_id').val($(this).find(':selected').data('employee_id'));
            });
        </script>

        {{-- update js --}}
        <script>
            $(document).on('click','.userUpdate',function()
            {
                var _this = $(this).parents('tr');
                $('#e_dtr_id').val(_this.find('.dtr_id').text());
                $('#e_name').val(_this.find('.name').text());
                var year = _this.find('.dtr_year').text();
                var date = _this.find('.dtr_date').text();
                var concatenated = year + '-' + date;
                $('#e_date').val(concatenated);
                $('#e_time_in').val(_this.find('.time_in').text());
                $('#e_break_out').val(_this.find('.break_out').text());
                $('#e_break_in').val(_this.find('.break_in').text());
                $('#e_time_out').val(_this.find('.time_out').text());
            });
        </script>
        
         {{-- delete js --}}
    <script>
        $(document).on('click','.salaryDelete',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>

    <script>
        function search() {
            var input = document.getElementById("name");
            var filter = input.value.toUpperCase();
            var table = $('#employee_table').DataTable(); // Get DataTables instance
            
            // Temporarily disable pagination by showing all rows
            var oldPaging = table.page.len();
            table.page.len(-1).draw(); // Show all rows

            // Clear existing search
            table.search('').draw();

            // Loop through all rows
            table.rows().every(function () {
                var rowData = this.data();
                var found = false;
                for (var j = 0; j < rowData.length; j++) {
                    if (rowData[j].toString().toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
                if (found) {
                    this.nodes().to$().show(); // Show row
                } else {
                    this.nodes().to$().hide(); // Hide row
                }
            });

            // Restore pagination state
            table.page.len(oldPaging).draw();
        }
    </script>


    @endsection
@endsection
