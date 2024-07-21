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
                        <h3 class="page-title">Payroll Records</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">HR Administration</a></li>
                            <li class="breadcrumb-item active">Payroll Records</li>
                        </ul>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->

            <!-- /Search Filter -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable" style="font-size: 14px !important;">
                            <thead>
                                <tr>
                                    <th>Description </th>
                                    <th>Period </th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Date Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <tr>
                                        <td>Daily Wage Payroll</td>
                                        <td>July 1 - 15, 2023</td>
                                        <td>56,000.00</td>
                                        <td>Done</td>
                                        <td>*</td>
                                        <td>Mon, Jul 17, 2023 10:39 AM</td>
                                    </tr>
                                    <tr>
                                        <td>Daily Wage Payroll</td>
                                        <td>July 16-31, 2023</td>
                                        <td>46,070.00</td>
                                        <td>Done</td>
                                        <td>*</td>
                                        <td>Mon, Jul 31, 2023 13:42 AM</td>
                                    </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
@endsection

