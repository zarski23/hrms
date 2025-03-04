@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}

    <style>
        .filter-row {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto; /* Allows horizontal scrolling if needed */
        }
        .filter-row .col-sm-6 {
            flex: 0 0 auto; /* Ensures columns don't shrink and maintain their width */
        }
        .btn-sm {
            padding: 0.25rem 0.5rem; /* Adjust padding for smaller buttons */
            font-size: 0.875rem; /* Adjust font size */
            line-height: 1.5; /* Ensure text fits well */
            border-radius: 0.2rem; /* Adjust border radius for smaller buttons */
        }
        .btn-block {
            display: block;
            width: 100%;
        }
    </style>

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Database Management <span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Assessment</a></li>
                        </ul>
                    </div>
                </div>
            </div>
             <!-- Search Filter -->
             <!-- <form action="" method="POST"> -->
                <!-- @csrf -->
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
                        <button type="submit" class="btn btn-info btn-block btn-sm" onclick="location.reload()"> Refresh </button>  
                    </div>
                    @if (Auth::user()->hr_user_role=='Super Admin')
                        <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">    
                            <a href="{{ route('download/applicants/rating') }}" style="text-transform:none;" class="btn btn-success btn-block btn-sm" ><i class="fa fa-download"></i> &nbsp; Download IES </a> 
                        </div>
                        <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">    
                            <a href="#" style="text-transform:none;" class="btn btn-success btn-block btn-sm" ><i class="fa fa-download"></i> &nbsp; Download IER </a> 
                        </div>
                        <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-12">  
                            <a href="#" style="text-transform:none;" class="btn btn-success btn-block btn-sm" ><i class="fa fa-download"></i> &nbsp; Download CAR </a> 
                        </div>
                    @endif
                </div>
                <br>
            <!-- </form>      -->
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="employee_table1" class="table table-striped custom-table" style="font-size: 13px !important;">
                            <thead>
                                <tr>
                                    <th hidden>ID</th>
                                    <th>Application Code</th>
                                    <th>Position Applied</th>
                                    <th>School Name</th>
                                    <th>School Address</th>
                                    <th class="text-center">Total Ratings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applicantInformation as $record)
                                <tr class="table_row">
                                    <td class="id" hidden>{{ $record->id }}</td>
                                    <td class="application_code" style="text-transform: uppercase;">{{ $record->application_code }}</td>
                                    <td class="position_applied" style="text-transform: uppercase;">{{ $record->application_title }}</td>
                                    <td class="school_name" style="text-transform: uppercase;">{{ $record->school_name }}</td>
                                    <td class="address" style="text-transform: uppercase;">{{ $record->school_barangay }} {{ $record->school_municipality }}</td>
                                    <td style="text-align: center; color: #0037ff; text-transform: uppercase;">{{ $record->total_points}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
    @section('script')
        <script>
            function swapRows() {
                const tbody = document.querySelector('#employee_table1 tbody');
                const rows = Array.from(tbody.querySelectorAll('tr')); // Convert NodeList to Array

                if (rows.length <= 1) return; // No need to swap if there are 1 or fewer rows

                // Move the first row to the end
                const firstRow = rows[0];

                // Append the first row at the end of tbody
                tbody.appendChild(firstRow);
            }

            // Set interval to automatically swap rows every 5 seconds
            setInterval(swapRows, 3000); // 3000 milliseconds = 3 seconds
        </script>
        
    @endsection
@endsection
