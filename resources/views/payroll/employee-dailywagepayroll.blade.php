
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
                        <h3 class="page-title">Daily Wage Payroll <span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">HR Administration</a></li>
                            <li class="breadcrumb-item active">Payroll</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Period Filter -->
            <form action="{{ route('generate/payroll') }}" method="POST">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-1 col-12">  
                        <div class="form-group form-focus">
                            <h4 style="">PERIOD:</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                @if(!empty($date_from))
                                <input class="form-control floating datetimepicker" type="text" name="date_from" value="{{$date_from}}">
                                @else
                                <input class="form-control floating datetimepicker" type="text" name="date_from" value="">
                                @endif
                            </div>
                            <label class="focus-label">From</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                @if(!empty($date_from))
                                <input class="form-control floating datetimepicker" type="text" name="date_to" value="{{$date_to}}">
                                @else
                                <input class="form-control floating datetimepicker" type="text" name="date_to" value="">
                                @endif
                            </div>
                            <label class="focus-label">To</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12"> 
                        <button type="submit" class="btn btn-info btn-block">Generate</button>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        @if(!empty($date_from))
                        <a href="{{ url('form/payroll/download', ['date_from' => $date_from, 'date_to' => $date_to]) }}" style="text-transform:none;" class="btn btn-success btn-block"  target="_blank"><i class="fa fa-file"></i> Download File</a> 
                        @else
                        <a href="" style="text-transform:none;" class="btn btn-success btn-block"  target="_blank"><i class="fa fa-file"></i> Download File</a> 
                        @endif
                    </div>              
                </div>
            </form>
            <!-- /Period Filter -->  
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable"  style="font-size: 13px !important;">
                            <thead>
                                @if (!empty($results))
                                @php $currentDepartment = null; $departmentNames = ''; @endphp
                                @foreach ($results as $result)
                                    @if ($result->department_name != $currentDepartment)
                                        @php $departmentNames .= ($departmentNames ? ', ' : '') . $result->department_name; @endphp
                                        @php $currentDepartment = $result->department_name; @endphp
                                    @endif
                                @endforeach

                                @if ($departmentNames)
                                    <tr style="background-color: #207e47; color: #ffffff;">
                                        <th colspan="12">DEPARTMENTS: {{$departmentNames}}</th>
                                    </tr>
                                @endif
                                @endif
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th colspan="2" class="text-center" style="border-color: black;">Deduction Undertime</th>
                                    <th></th>
                                    <th colspan="3" class="text-center" style="border-color: black;">Community Tax</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Employee</th>
                                    <th>Designation</th>
                                    <th>No. of days worked</th>
                                    <th>Rate per Day</th>
                                    <th>Gross Salary</th>
                                    <th>Mins.</th>
                                    <th>Amt.</th>
                                    <th>Net Salary</th>
                                    <th>Number</th>
                                    <th>Date</th>
                                    <th>Place of Issue</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($results))
                                    @php 
                                        $currentDepartment = null; 
                                        $totalGrossResult = 0;
                                        $totalLatePenalty = 0;
                                        $totalNetSalary = 0;
                                    @endphp
                                @foreach ($results as $result)
                                    @if ($result->department_name != $currentDepartment)
                                        <tr>
                                            <td style="background-color: #b2f2ed;">{{$result->department_name}}</td>
                                            <td colspan="11"></td>
                                        </tr>
                                        @php $currentDepartment = $result->department_name; @endphp
                                    @endif
                                    <tr>
                                        <td>{{$result->user->last_name}}, {{$result->user->first_name}} {{ Illuminate\Support\Str::limit($result->user->middle_name, 1, '.') }}</td>
                                        <td>{{$result->employment_type}}</td>
                                        <td style="text-align: center;">{{$result->days_worked}}</td>
                                        <td>{{ number_format($result->daily_salary, 2, '.', ',') }}</td>
                                        <td>{{ number_format($result->gross_result, 2, '.', ',') }}</td>
                                        <td>{{$result->late}}</td>
                                        <td>{{ number_format(floor($result->late_penalty * 100) / 100, 2, '.', ',') }}</td>
                                        <td>{{ number_format($result->net_salary, 2, '.', ',') }}</td>
                                        <td>{{$result->number}}</td>
                                        <td>{{$result->date}}</td>
                                        <td>{{$result->place_issued}}</td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item userUpdate" data-toggle="modal" data-id="'.$result->user_id.'" data-target="#edit_user"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item userDelete" href="#" data-toggle="modal" ata-id="'.$result->user_id.'" data-target="#delete_user"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    @php
                                        // Accumulate values for the total
                                        $totalGrossResult += $result->gross_result;
                                        $totalLatePenalty += floor($result->late_penalty * 100) / 100;
                                    @endphp

                                @endforeach

                                    @php
                                        // Gross Salary - Amt.
                                        $totalNetSalary = $totalGrossResult - $totalLatePenalty;
                                    @endphp

                                <tr style="background-color: #ffb7b7;">
                                    <td >TOTAL AMOUNT</td>
                                    <td colspan="3"></td>   
                                    <td>{{ number_format($totalGrossResult, 2, '.', ',') }}</td>
                                    <td></td>

                                    <td>{{ number_format(floor($totalLatePenalty * 100) / 100, 2, '.', ',') }}</td>
                                    <td>{{ number_format($totalNetSalary, 2, '.', ',') }}</td>
                                    <td colspan="4"></td>
                                </tr>
                                @endif
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
        
        <!-- Edit Salary Modal -->
        <div id="edit_salary" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Staff Salary</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            @csrf
                            <input class="form-control" type="hidden" name="id" id="e_id" value="" readonly>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>Name Staff</label>
                                        <input class="form-control " type="text" name="name" id="e_name" value="" readonly>
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Net Salary</label>
                                    <input class="form-control" type="text" name="salary" id="e_salary" value="">
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <h4 class="text-primary">Earnings</h4>
                                    <div class="form-group">
                                        <label>Basic</label>
                                        <input class="form-control" type="text" name="basic" id="e_basic" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>DA(40%)</label>
                                        <input class="form-control" type="text"  name="da" id="e_da" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>HRA(15%)</label>
                                        <input class="form-control" type="text"  name="hra" id="e_hra" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Conveyance</label>
                                        <input class="form-control" type="text"  name="conveyance" id="e_conveyance" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Allowance</label>
                                        <input class="form-control" type="text"  name="allowance" id="e_allowance" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Medical  Allowance</label>
                                        <input class="form-control" type="text" name="medical_allowance" id="e_medical_allowance" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6">  
                                    <h4 class="text-primary">Deductions</h4>
                                    <div class="form-group">
                                        <label>TDS</label>
                                        <input class="form-control" type="text" name="tds" id="e_tds" value="">
                                    </div> 
                                    <div class="form-group">
                                        <label>ESI</label>
                                        <input class="form-control" type="text" name="esi" id="e_esi" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>PF</label>
                                        <input class="form-control" type="text" name="pf" id="e_pf" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Leave</label>
                                        <input class="form-control" type="text" name="leave" id="e_leave" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Prof. Tax</label>
                                        <input class="form-control" type="text" name="prof_tax" id="e_prof_tax" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Loan</label>
                                        <input class="form-control" type="text" name="labour_welfare" id="e_labour_welfare" value="">
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
        <!-- /Edit Salary Modal -->
        
        <!-- Delete Salary Modal -->
        <div class="modal custom-modal fade" id="delete_salary" role="dialog">
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
        </div>
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
            $(document).on('click','.userSalary',function()
            {
                var _this = $(this).parents('tr');
                $('#e_id').val(_this.find('.id').text());
                $('#e_name').val(_this.find('.name').text());
                $('#e_salary').val(_this.find('.salary').text());
                $('#e_basic').val(_this.find('.basic').text());
                $('#e_da').val(_this.find('.da').text());
                $('#e_hra').val(_this.find('.hra').text());
                $('#e_conveyance').val(_this.find('.conveyance').text());
                $('#e_allowance').val(_this.find('.allowance').text());
                $('#e_medical_allowance').val(_this.find('.medical_allowance').text());
                $('#e_tds').val(_this.find('.tds').text());
                $('#e_esi').val(_this.find('.esi').text());
                $('#e_pf').val(_this.find('.pf').text());
                $('#e_leave').val(_this.find('.leave').text());
                $('#e_prof_tax').val(_this.find('.prof_tax').text());
                $('#e_labour_welfare').val(_this.find('.labour_welfare').text());
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
    @endsection
@endsection
