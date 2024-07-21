
@extends('layouts.exportmaster')
@section('content')
    <!-- Page Wrapper -->
    <div class="">
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid" id="app">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col" style="margin-left: -222px;">
                        <h3 class="page-title">Payroll Report</h3>
                        <ul class="breadcrumb">
                        <li class="breadcrumb-item">HR Administration</li>
                            <li class="breadcrumb-item active"><a href="{{ route('payroll/report/page') }}">Payroll</a></li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-white"><a href=""@click.prevent="printme" target="_blank">PDF</a></button>
                            <button class="btn btn-white"><i class="fa fa-print fa-lg"></i><a href="" @click.prevent="printme" target="_blank"> Print</a></button>
                        </div>
                    </div>
                </div>
           
            <div class="row" style="margin-left: -240px;">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="payslip-title">DAILY WAGE PAYROLL</h4>
                            <p>
                                LGU : Barugo, Leyte<br>
                                Period : {{$combinedDate}}
                            </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div >
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
                                            @php $currentDepartment = null; @endphp
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
                                                    <td>{{ number_format($result->late_penalty, 2, '.', ',') }}</td>
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
                                            @endforeach

                                            <tr style="background-color: #ffb7b7;">
                                                <td >TOTAL AMOUNT</td>
                                                <td colspan="3"></td>
                                                <td>{{ number_format($totalGrossResult, 2, '.', ',') }}</td>
                                                <td></td>
                                                <td>{{ number_format($totalLatePenalty, 2, '.', ',') }}</td>
                                                <td>{{ number_format($totalNetSalary, 2, '.', ',') }}</td>
                                                <td colspan="4"></td>
                                            </tr>
                                            @endif
                                            <tr>
                                            @foreach ($signatories as $index => $signatory)
                                                @if ($index == 0)
                                                <td colspan="3" style="text-align: center; border: solid 1px gray;">
                                                                Each person whose name appears on this<br>
                                                                roll had rendered services for the time stated.<br><br>
                                                                <h5 style="text-decoration: underline;">{{$signatory->complete_name}}</h5>
                                                                {{$signatory->position}}            
                                                </td>
                                                @endif
                                                @if ($index == 1)
                                                <td colspan="4"style="text-align: center; border: solid 1px gray;"><br><br><br>
                                                                <h5 style="text-decoration: underline;">{{$signatory->complete_name}}</h5>
                                                                {{$signatory->position}} 
                                                </td>
                                                @endif
                                                @if ($index == 2)
                                                <td colspan="5"style="text-align: center; border: solid 1px gray;">
                                                                CERTIFIED: Each person whose name appears above roll has <br>
                                                                been paid amount stated his name after identifying him.<br><br>
                                                                <h5 style="text-decoration: underline;">{{$signatory->complete_name}}</h5>
                                                                {{$signatory->position}}
                                                                </td>
                                                @endif
                                            @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    </div>
@endsection
